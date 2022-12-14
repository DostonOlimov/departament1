<?php

namespace backend\controllers\shopping;

use common\models\shopping\Company;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CompanyController extends Controller
{
    public function behaviors()
    {
        return [
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
        $searchModel = new ProCompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        $model = new ProCompany();

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
            return $this->redirect(['/shopping/shopping/view', 'id' => $model->shoppingInstruction->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
