<?php

namespace backend\controllers\control;

use common\models\control\Measure;
use common\models\control\MeasureSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeasureController implements the CRUD actions for Measure model.
 */
class MeasureController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::class,
                'only' => ['update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['admin'],
                    ],
                ],
            ],*/
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
        $searchModel = new MeasureSearch();
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
        $model = new Measure();

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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->type == Measure::TYPE_ADMINISTRATIVE) {
                $model->date = null;
                $model->quantity = null;
                $model->amount = null;
            } else {
                $model->person = null;
                $model->number_passport = null;
                $model->fine_amount = null;
            }
            if ($model->save(false)) {
                return $this->redirect(['/control/control/view', 'id' => $model->controlCompany->control_instruction_id]);
            }
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
        if (($model = Measure::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
