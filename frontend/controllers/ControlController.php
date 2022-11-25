<?php

namespace frontend\controllers;

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Identification;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use common\models\control\InstructionUser;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryOvSearch;
use common\models\control\PrimaryProduct;
use common\models\control\Laboratory;
use common\models\control\PrimaryProductSearch;
use common\models\control\ProPrimaryData;
use common\models\Model;
use Exception;
use frontend\models\PrimaryDataForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class ControlController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
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

    public function actionInstruction()
    {
        $model = new Instruction();

        if ($model->load($this->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                if ($model->employers) {
                    foreach ($model->employers as $employer) {
                        $insUser = new InstructionUser();
                        $insUser->instruction_id = $model->id;
                        $insUser->user_id = $employer;
                        $insUser->save(false);
                    }
                }
                $transaction->commit();
                return $this->redirect(['company', 'instruction_id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
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
        $model->control_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['primary-data', 'company_id' => $model->id]);
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

    public function actionPrimaryData($company_id)
    {
        $model = new PrimaryData();
        $model->control_company_id = $company_id;

        $products = [new PrimaryDataForm];

        $products[1] = new PrimaryDataForm();
        $products[1]->category = PrimaryDataForm::CATEGORY_PRODUCT;
        $pro_primary[0] = [new ProPrimaryData];
        $pro_primary[1] = [new ProPrimaryData];

        $post = $this->request->post();
        if ($model->load($post)) {

//            VarDumper::dump($post,12,true);die;
            unset($products[1]);
            unset($pro_primary[1]);
            $products = Model::createMultiple(PrimaryDataForm::classname(), $products);
            Model::loadMultiple($products, $this->request->post());

            $valid = $model->validate() && Model::validateMultiple($products);
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->save(false);
                    foreach ($products as $key => $product) {

                        if ($product->category == PrimaryDataForm::CATEGORY_OV) {
                            $ov = new PrimaryOv();
                            $ov->control_primary_data_id = $model->id;
                            $ov->type = $product->type;
                            $ov->measurement = $product->measurement;
                            $ov->compared = $product->compared;
                            $ov->invalid = $product->invalid;
                            $ov->save(false);
                        } else {
                            if ($product->product_type_id || $product->product_name || $product->nd || $product->number_blank || $product->number_reestr || $product->date_from || $product->date_to) {
                                $prod = new PrimaryProduct();
                                $prod->control_primary_data_id = $model->id;
                                $prod->product_type_id = $product->product_type_id;
                                $prod->product_name = $product->product_name;
                                $prod->nd = $product->nd ? implode(',', $product->nd) : null;
                                $prod->number_blank = $product->number_blank;
                                $prod->number_reestr = $product->number_reestr;
                                $prod->date_from = $product->date_from;
                                $prod->date_to = $product->date_to;
                                $prod->save(false);
                                foreach ($post['ProPrimaryData'][$key] as $proData) {
                                    $pro = new ProPrimaryData();
                                    $pro->control_primary_id = $prod->id;
                                    $pro->product_name = $proData['product_name'];
                                    $pro->product_date = $proData['product_date'];
                                    $pro->save(false);
                                }
                            }
                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['identification', 'company_id' => $company_id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
        return $this->render('primary-data', [
            'model' => $model,
            'products' => $products,
            'pro_primary' => $pro_primary,
        ]);
    }

    public function actionPrimaryDataView($id)
    {
        $searchOv = new PrimaryOvSearch($id);
        $dataOv = $searchOv->search($this->request->queryParams);

        $searchProduct = new PrimaryProductSearch($id);
        $dataProduct = $searchProduct->search($this->request->queryParams);

        return $this->render('primary-data-view', [
            'model' => $this->getModel(PrimaryData::className(), $id),
            'searchOv' => $searchOv,
            'dataOv' => $dataOv,
            'searchProduct' => $searchProduct,
            'dataProduct' => $dataProduct,
        ]);
    }

    public function actionIdentification($company_id)
    {
        $model = [new Identification];

        if (Yii::$app->request->post()) {

            $model = Model::createMultiple(Identification::classname(), $model);
            Model::loadMultiple($model, $this->request->post());

            foreach ($model as $index => $modelOptionValue) {
                $modelOptionValue->img = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]file");
                if ($modelOptionValue->img) {
                    $modelOptionValue->file = $modelOptionValue->img->name;
                }
            }

            if (Model::validateMultiple($model)) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach ($model as $key => $product) {

//                        if ($product->file) {
                        $product->control_company_id = $company_id;
                        $product->save(false);
//                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['laboratory', 'company_id' => $company_id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('identification', [
            'model' => $model,
            'company_id' => $company_id,
        ]);
    }

    public function actionIdentificationView($id)
    {
        return $this->render('identification-view', [
            'model' => Identification::find()->where(['control_company_id' => $id])->all(),
            'id' => $id
        ]);
    }

    public function actionLaboratory($company_id)
    {
        $model = new Laboratory();
        $model->control_company_id = $company_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['defect', 'company_id' => $company_id]);
        }

        return $this->render('laboratory', [
            'model' => $model,
        ]);
    }

    public function actionUpdateLab($id, $attribute)
    {
        $model = Laboratory::findOne($id);
        $model->$attribute = $_FILES[$attribute]['name'];
        $model->validate();
        $model->save();
        return $this->redirect(['laboratory-view', 'id' => $id]);

    }

    public function actionLaboratoryView($id)
    {
        return $this->render('laboratory-view', [
            'model' => $this->getModel(Laboratory::className(), $id)
        ]);
    }

    public function actionDefect($company_id)
    {
        $model = new Defect();
        $model->control_company_id = $company_id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $typeRes = '';
            foreach ($model->type as $type) {
                $typeRes .= '.' . $type;
            }
            $model->type = $typeRes;
            if ($model->type == '.4') {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->save(false);
                    $ins = Instruction::findOne($model->controlCompany->control_instruction_id);
                    $ins->checkup_finish_date = Yii::$app->formatter->asDate(time(), 'M/dd/yyyy');
                    $ins->general_status = Instruction::GENERAL_STATUS_SEND;
                    $ins->save(false);
                    $transaction->commit();
                    return $this->redirect(['defect-view', 'id' => $model->id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
            if ($model->save()) {
                return $this->redirect(['caution', 'company_id' => $company_id]);
            }
        }
        return $this->render('defect', [
            'model' => $model,
        ]);
    }

    public function actionDefectView($id)
    {
        return $this->render('defect-view', [
            'model' => $this->getModel(Defect::className(), $id)
        ]);
    }

    public function actionCaution($company_id)
    {
        $model = [new Caution];

        if (Yii::$app->request->post()) {

            $model = Model::createMultiple(Caution::classname(), $model);
            Model::loadMultiple($model, $this->request->post());

            foreach ($model as $index => $modelOptionValue) {
                $modelOptionValue->s_file = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]file");
                if ($modelOptionValue->s_file) {
                    $modelOptionValue->file = $modelOptionValue->s_file->name;
                }
            }

            if (Model::validateMultiple($model)) {
//                VarDumper::dump($model,12,true);die;
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach ($model as $key => $product) {
                        $product->control_company_id = $company_id;
                        $product->save(false);
                    }
                    $transaction->commit();
                    return $this->redirect(['measure', 'company_id' => $company_id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('caution', [
            'model' => $model,
            'company_id' => $company_id
        ]);
    }

    public function actionCautionView($id)
    {
        return $this->render('caution-view', [
            'model' => Caution::find()->where(['control_company_id' => $id])->all(),
            'id' => $id,
        ]);
    }

    public function actionMeasure($company_id)
    {
        $model = new Measure();
        $model->control_company_id = $company_id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->type) {
                $model->type = implode(",", $model->type);
            }
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                $ins = Instruction::findOne($model->controlCompany->control_instruction_id);
                $ins->checkup_finish_date = Yii::$app->formatter->asDate(time(), 'M/dd/yyyy');
                $ins->general_status = Instruction::GENERAL_STATUS_SEND;
                $ins->save(false);
                $transaction->commit();
                return $this->redirect(['/control/measure-view', 'id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('measure', [
            'model' => $model,
        ]);
    }

    public function actionMeasureView($id)
    {
        return $this->render('measure-view', [
            'model' => $this->getModel(Measure::className(), $id)
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
