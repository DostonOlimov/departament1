<?php

namespace backend\controllers\control;

use common\models\control\PrimaryOv;
use common\models\PrimaryOvSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrimaryOvController implements the CRUD actions for PrimaryOv model.
 */
class PrimaryOvController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'delete', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete', 'create'],
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

    /**
     * Lists all PrimaryOv models.
     * @return mixed
     */
    public function actionIndex($primary_data_id)
    {
        $searchModel = new PrimaryOvSearch($primary_data_id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'primary_data_id' => $primary_data_id,
        ]);
    }

    /**
     * Displays a single PrimaryOv model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PrimaryOv model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($control_primary_data_id)
    {
        $model = new PrimaryOv();

        if ($this->request->isPost) {
            $model->control_primary_data_id = $control_primary_data_id;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'control_primary_data_id' => $control_primary_data_id
        ]);
    }

    /**
     * Updates an existing PrimaryOv model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'primary_data_id' => $model->control_primary_data_id
        ]);
    }

    /**
     * Deletes an existing PrimaryOv model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $primary_data_id = $this->findModel($id)->control_primary_data_id;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'primary_data_id' => $primary_data_id]);
    }

    /**
     * Finds the PrimaryOv model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PrimaryOv the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrimaryOv::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
