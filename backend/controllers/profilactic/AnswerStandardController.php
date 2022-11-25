<?php

namespace backend\controllers\profilactic;

use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\AnswerStandardCountSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProAnswerStandardController implements the CRUD actions for ProAnswerStandardCount model.
 */
class AnswerStandardController extends Controller
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

    public function actionIndex($answer_id)
    {
        $searchModel = new AnswerStandardCountSearch($answer_id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'answer_id' => $answer_id,
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

    public function actionCreate($answer_id)
    {
        $model = new AnswerStandardCount();
        $model->pro_answer_id = $answer_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id, $answer_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'answer_id' => $answer_id]);
    }

    protected function findModel($id)
    {
        if (($model = AnswerStandardCount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
