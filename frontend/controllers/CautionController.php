<?php

namespace frontend\controllers;

use common\models\caution\Execution;
use common\models\caution\Company;
use common\models\caution\Instruction;
use common\models\caution\InstructionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * cautions controller
 */
class CautionController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInstruction()
    {
        $model = new Instruction();

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['company', 'instruction_id' => $model->id]);
        }

        return $this->render('instruction', [
            'model' => $model
        ]);
    }

    public function actionInstructionView($id)
    {
        return $this->render('instruction-view', [
            'model' => $this->getModel(Instruction::className(), $id)
        ]);
    }

    public function actionCompany($instruction_id)
    {
        $model = new Company();
        $model->caution_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['execution', 'company_id' => $model->id]);
        }

        return $this->render('company', [
            'model' => $model,
        ]);
    }

    public function actionCompanyView($id)
    {
        return $this->render('company-view', [
            'model' => $this->getModel(Company::className(), $id)
        ]);
    }

    public function actionExecution($company_id)
    {
        $model = new Execution();
        $model->caution_company_id = $company_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/caution/index']);
        }
        return $this->render('execution', [
            'model' => $model
        ]);
    }

    public function actionExecutionView($id)
    {
        return $this->render('execution-view', [
            'model' => $this->getModel(Execution::className(), $id)
        ]);
    }

    private function getModel($className, $id, $attribute = 'id')
    {
        if (!$model = $className::findOne([$attribute => $id])) {
            throw new \yii\db\Exception('Ma`lumot topilmadi');
        }
        return $model;
    }


}
