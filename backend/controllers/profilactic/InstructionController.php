<?php

namespace backend\controllers\profilactic;

use common\models\Disorder;
use common\models\profilactic\Answer;
use common\models\profilactic\AnswerCountry;
use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\Company;
use common\models\profilactic\Instruction;
use common\models\profilactic\Result;
use common\models\profilactic\ResultCountry;
use common\models\profilactic\ResultNd;
use common\models\profilactic\ResultNormative;
use common\models\profilactic\ResultOldNd;
use common\models\profilactic\ResultStandart;
use Exception;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class InstructionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /*public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProInstruction::find(),

            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new ProInstruction();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/profilactic/profilactic/view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $company = Company::findOne(['pro_instruction_id' => $id]);

        if ($company) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $result = Result::findOne(['pro_company_id' => $company->id]);
                if ($result) {
                    ResultCountry::deleteAll(['pro_result_id' => $result->id]);
                    if ($nd = ResultNd::findOne(['result_id' => $result->id])) {
                        ResultOldNd::deleteAll(['result_nd_id' => $nd->id]);
                        ResultNd::deleteAll(['result_id' => $result->id]);
                    }
                    ResultStandart::deleteAll(['pro_result_id' => $result->id]);
                    ResultNormative::deleteAll(['pro_result_id' => $result->id]);
                    Result::deleteAll(['pro_company_id' => $company->id]);
                }
                $answer = Answer::findOne(['pro_company_id' => $company->id]);
                Disorder::deleteAll(['company_id' => $company->id]);
                if ($answer) {
                    AnswerCountry::deleteAll(['pro_answer_id' => $answer->id]);
                    AnswerStandardCount::deleteAll(['pro_answer_id' => $answer->id]);
                    Answer::deleteAll(['pro_company_id' => $company->id]);
                }
                Company::deleteAll(['pro_instruction_id' => $id]);
                $this->findModel($id)->delete();
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['/profilactic/profilactic/index']);
    }

    protected function findModel($id)
    {
        if (($model = Instruction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
