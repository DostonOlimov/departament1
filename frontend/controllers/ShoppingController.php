<?php

namespace frontend\controllers;

use common\models\shopping\Company;
use common\models\shopping\Instruction;
use common\models\shopping\InstructionSearch;
use common\models\shopping\Product;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Site controller
 */
class ShoppingController extends Controller
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
            'model' => $model,
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
        $model->shopping_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['product', 'company_id' => $model->id]);
        }

        return $this->render('company', [
            'model' => $model
        ]);
    }

    public function actionCompanyView($id)
    {
        return $this->render('company-view', [
            'model' => $this->getModel(Company::className(), $id)
        ]);
    }

    public function actionProduct($company_id)
    {
        $model = new Product();
        $model->shopping_company_id = $company_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/shopping/index']);
        }

        return $this->render('product', [
            'model' => $model
        ]);
    }

    public function actionProductView($id)
    {
        return $this->render('product-view', [
            'model' => $this->getModel(Product::className(), $id)
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
