<?php

namespace backend\controllers\control;

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Identification;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use common\models\control\InstructionUser;
use common\models\control\Laboratory;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\control\ProPrimaryData;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstructionController implements the CRUD actions for Instruction model.
 */
class InstructionController extends Controller
{
    /**
     * @inheritDoc
     */
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
        $searchModel = new InstructionSearch();
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
        $model = new Instruction();

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
            return $this->redirect(['/control/control/view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $company = Company::findOne(['control_instruction_id' => $id]);

        if ($company) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $primaryData = PrimaryData::findOne(['control_company_id' => $company->id]);
                if ($primaryData) {
                    if ($nd = PrimaryProduct::findOne(['control_primary_data_id' => $primaryData->id])) {
			//\yii\helpers\VarDumper::dump($nd,12,true);die;
			//\yii\helpers\VarDumper::dump(ProPrimaryData::deleteAll(['control_pxrimary_id' => $nd->id]),12,true);die;
                        ProPrimaryData::deleteAll(['control_primary_id' => $nd->id]);
                    }
		    PrimaryProduct::deleteAll(['control_primary_data_id' => $primaryData->id]);    
                    PrimaryOv::deleteAll(['control_primary_data_id' => $primaryData->id]);
                    PrimaryData::deleteAll(['control_company_id' => $company->id]);
                }
                Identification::deleteAll(['control_company_id' => $company->id]);
                Laboratory::deleteAll(['control_company_id' => $company->id]);
                Defect::deleteAll(['control_company_id' => $company->id]);
                Caution::deleteAll(['control_company_id' => $company->id]);
		Measure::deleteAll(['control_company_id' => $company->id]);
                $company->delete();
                InstructionUser::deleteAll(['instruction_id' => $id]);
                $this->findModel($id)->delete();
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            InstructionUser::deleteAll(['instruction_id' => $id]);
            $this->findModel($id)->delete();
        }

        return $this->redirect(['/control/control/index']);
    }

    protected function findModel($id)
    {
        if (($model = Instruction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
