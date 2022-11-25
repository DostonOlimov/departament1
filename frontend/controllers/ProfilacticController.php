<?php

namespace frontend\controllers;

use common\models\Disorder;
use common\models\profilactic\AnswerStandardCountSearch;
use common\models\profilactic\ResultNd;
use common\models\profilactic\ResultNormative;
use common\models\profilactic\ResultOldNd;
use common\models\profilactic\ResultStandart;
use frontend\models\ResultDataForm;
use common\models\profilactic\InstructionSearch;
use common\models\Model;
use common\models\profilactic\Answer;
use common\models\profilactic\AnswerCountry;
use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\Company;
use common\models\profilactic\Instruction;
use common\models\profilactic\Result;
use common\models\profilactic\ResultCountry;
use Exception;
use frontend\models\ResultLastDataForm;
use http\Exception\RuntimeException;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Site controller
 */
class ProfilacticController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }

    public function actionInstruction()
    {
        $model = new Instruction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['xyus-information', 'instruction_id' => $model->id]);
        }

        return $this->render('instruction', [
            'model' => $model
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new InstructionSearch(Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInsView($id)
    {
        return $this->render('ins-view', [
            'model' => Instruction::findOne($id),
        ]);
    }

    public function actionXyusInformation($instruction_id)
    {
        if ($model = Company::findOne(['pro_instruction_id' => $instruction_id])) {
            return $this->redirect(['com-view', 'id' => $model->id]);
        }
        $model = new Company();
        $model->pro_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['questionnaire', 'company_id' => $model->id]);
        }

        return $this->render('xyus_information', [
            'instruction_id' => $instruction_id,
            'model' => $model,
        ]);
    }

    public function actionComView($id)
    {
        return $this->render('com-view', [
            'model' => Company::findOne($id),
        ]);
    }

    public function actionQuestionnaire($company_id)
    {
        if ($model = Answer::findOne(['pro_company_id' => $company_id])) {
            return $this->redirect(['ans-view', 'id' => $model->id]);
        }
        $model = new Answer();
        $model->pro_company_id = $company_id;

        $answerStandardCount = [new AnswerStandardCount];

        $post = $this->request->post();
        if ($model->load($post)) {

            $answerStandardCount = Model::createMultiple(AnswerStandardCount::classname(), $answerStandardCount);
            Model::loadMultiple($answerStandardCount, $post);

            $valid = $model->validate();
            
            $valid = Model::validateMultiple($answerStandardCount) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->save(false);

                    $this->saveStandard($answerStandardCount, $model->id);

                    if ($model->import) {
                        foreach ($model->import as $country_id) {
                            $country = new AnswerCountry();
                            $country->country_id = $country_id;
                            $country->import_export = "import";
                            $country->pro_answer_id = $model->id;
                            $country->save(false);
                        }
                    }
                    if ($model->export) {
                        foreach ($model->export as $country_id) {
                            $country = new AnswerCountry();
                            $country->country_id = $country_id;
                            $country->import_export = "export";
                            $country->pro_answer_id = $model->id;
                            $country->save(false);
                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['disorder', 'company_id' => $company_id, 'type' => 0]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
        return $this->render('questionnaire', [
            'model' => $model,
            'answerStandardCount' => $answerStandardCount,
        ]);
    }

    public function actionDisorder($company_id, $type)
    {
        if ($model = Disorder::findOne(['company_id' => $company_id, 'type' => $type])) {
            return $this->redirect(['dis-view', 'id' => $model->id, 'type' => $type]);
        }
        $model = new Disorder();
        $model->company_id = $company_id;
        $model->type = $type;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                if ($type == 0){
                    $transaction->commit();
                    return $this->redirect(['disorder', 'company_id' => $company_id, 'type' => 1]);
                }
                $ins = Instruction::findOne($model->company->pro_instruction_id);
                $ins->general_status = Instruction::GENERAL_STATUS_SEND;
                $ins->save(false);
                $transaction->commit();
                return $this->redirect(['dis-view', 'id' => $model->id, 'type' => 1]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }

        return $this->render('disorder', [
            'model' => $model,
            'type' => $type
        ]);
    }

    public function actionDisView($id, $type)
    {
        return $this->render('dis-view', [
            'model' => Disorder::findOne($id)
        ]);
    }

    public function actionAnsView($id)
    {
        $searchStan = new AnswerStandardCountSearch($id);
        $dataProvider = $searchStan->search(Yii::$app->request->queryParams);

        return $this->render('ans-view', [
            'searchStan' => $searchStan,
            'dataProvider' => $dataProvider,
            'model' => Answer::findOne($id),
        ]);
    }

    public function actionResults($company_id, $selfId = null)
    {
        if ($selfId) {
            $model = Result::findOne($selfId);
        } else {
            $model = new Result();
        }
        $model->pro_company_id = $company_id;
        $answerStandardCount = [new ResultNd];
        $modelsRoom = [[new ResultOldNd]];
        $modelStandart = [new ResultLastDataForm];

        $post = $this->request->post();
        if ($model->load($post)) {

            $modelStandart = Model::createMultiple(ResultLastDataForm::classname(), $modelStandart);
            Model::loadMultiple($modelStandart, $post);

            $answerStandardCount = Model::createMultiple(ResultNd::classname(), $answerStandardCount);
            Model::loadMultiple($answerStandardCount, $post);

            $valid = $model->validate() && Model::validateMultiple($modelStandart) && Model::validateMultiple($answerStandardCount);

            if (isset($_POST['ResultOldNd'][0][0])) {
                foreach ($_POST['ResultOldNd'] as $indexHouse => $rooms) {
                    foreach ($rooms as $indexRoom => $room) {
                        $data['ResultOldNd'] = $room;
                        $modelRoom = new ResultOldNd;
                        $modelRoom->load($data);
                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
                        $valid = $valid && $modelRoom->validate();
                    }
                }
            }
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->save(false);
                    foreach ($modelStandart as $stan) {
                        if ($stan->category == ResultLastDataForm::STANDARD && ($stan->standard_name || $stan->standard_count)){
                            $standard = new ResultStandart();
                            $standard->nd_id = $stan->standard_name;
                            $standard->pro_result_id = $model->id;
                            $standard->standard_name = $stan->standard_count;
                            $standard->save(false);
                        }
                        if ($stan->category == ResultLastDataForm::HELP && ($stan->help_name || $stan->help_count)){
                            $standard = new ResultNormative();
                            $standard->pro_result_id = $model->id;
                            $standard->nd_id = $stan->help_name;
                            $standard->help_name = $stan->help_count;
                            $standard->save(false);
                        }
                    }
                    foreach ($answerStandardCount as $indexHouse => $modelHouse) {

                        $modelHouse->result_id = $model->id;
                        $modelHouse->save(false);

                        if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
                            foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
                                $modelRoom->result_nd_id = $modelHouse->id;
                                $modelRoom->save(false);
                            }
                        }
                    }
                    if ($model->countries) {
                        foreach ($model->countries as $country_id) {
                            $country = new ResultCountry();
                            $standard->pro_result_id = $model->id;
                            $country->country_id = $country_id;
                            $country->pro_result_id = $model->id;
                            !$country->save(false);
                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['index']);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('results', [
            'company_id' => $company_id,
            'model' => $model,
            'answerStandardCount' => $answerStandardCount,
            'selfId' => $selfId,
            'modelsRoom' => $modelsRoom,
            'modelStandart' => $modelStandart,
        ]);
    }

    public function actionResView($id)
    {
        return $this->render('res-view', [
            'model' => Result::findOne($id),
        ]);
    }

    private function saveStandard($models, $answer_id)
    {
        foreach ($models as $model) {
            /**@var $model AnswerStandardCount */
            if ($model->name) {
                $model->pro_answer_id = $answer_id;
                $model->save(false);
            }
        }
    }

}
