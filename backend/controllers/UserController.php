<?php

namespace backend\controllers;

use common\models\User;
use backend\models\UserSearch;
use common\models\UserEditForm;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
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

    public function actionIndex()
    {
        $searchModel = new UserSearch();
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
        $model = new User();

        if ($model->load($this->request->post()) && $model->validate()) {
            $model->setPassword($model->pass);
            $model->status = User::STATUS_ACTIVE;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save();
                \Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $form = new UserEditForm($id);
        $form->id = $model->id;
        $form->role = $model->role;
        $form->username = $model->username;
        $form->name = $model->name;
        $form->surname = $model->surname;
        $form->fathers_name = $model->fathers_name;
        $form->phone = $model->phone;

        if ($form->load($this->request->post()) /*&& $form->validate()*/) {

            $model->role = $form->role;
            $model->username = $form->username;
            $model->name = $form->name;
            $model->surname = $form->surname;
            $model->fathers_name = $form->fathers_name;
            $model->phone = $form->phone;
            if ($form->pass) {
                $model->setPassword($form->pass);
            }
//            VarDumper::dump($model,12,true);die;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                \Yii::$app->authManager->revoke(Yii::$app->authManager->getRole($model->role), $model->id);
                \Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;
        if ($model->save(false)) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
