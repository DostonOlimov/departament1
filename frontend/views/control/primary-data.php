<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\ProductType;
use common\models\control\ProPrimaryData;
use common\models\Nd;
use common\models\NdType;
use frontend\models\PrimaryDataForm;
use frontend\widgets\Steps;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Birlamchi ma`lumotlar';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="page1-1 row">

        <?= Steps::widget([
            'control_instruction_id' => $model->controlCompany->controlInstruction->id,
            'control_company_id' => $model->control_company_id,
        ]) ?>

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
        ]) ?>

        <div class="row">
            <div class="box box-default" style="display: inline-block">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $products[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'category',
                            'type',
                            'measurement',
                            'compared',
                            'invalid',
                            'product_type_id',
                            'product_name',
                            'nd',
                            'nd_type',
                            'number_blank',
                            'number_reestr',
                            'date_from',
                            'date_to',
                        ],
                    ]); ?>

                    <div class="container-items">
                        <?php foreach ($products as $i => $stan):
                            if ($i == 1) {
                                continue;
                            } ?>
                            <div class="item panel panel-default item-product itemlar">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs" id="removeBtn">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 categoriya" style="display: none;">
                                            <?= $form->field($stan, "[{$i}]category")->dropDownList(PrimaryDataForm::categoryList(), ['onchange' => 'handleChange(event)']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" style="display: none">
                                            <?= $form->field($stan, "[{$i}]product_type_id")->dropDownList(ArrayHelper::map(ProductType::find()->all(), 'id', 'name')) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" style="display: none">
                                            <?= $form->field($stan, "[{$i}]product_name")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 renderForm" style="display: none">
                                            <?php
                                            echo $this->render('_form_primary', [
                                                'form' => $form,
                                                'primaryIndex' => $i,
                                                'pro_primary' => !isset($pro_primary[$i]) ? [new ProPrimaryData] : $pro_primary[$i],
                                            ]) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" style="display: none">
                                            <?= $form->field($stan, "[{$i}]nd_type")->dropDownList(ArrayHelper::map(NdType::find()->all(), 'id', 'name')) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2" style="display: none">
                                            <?= $form->field($stan, "[{$i}]number_blank")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2" style="display: none">
                                            <?= $form->field($stan, "[{$i}]number_reestr")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2" style="display: none">
                                            <?= $form->field($stan, "[{$i}]date_from")->input('date') ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" style="display: none">
                                            <?= $form->field($stan, "[{$i}]date_to")->input('date') ?>
                                        </div>

                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]type")->dropDownList(PrimaryOv::getType()) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]measurement")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]compared")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]invalid")->textInput() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>
        <hr class="mt-3 mb-3">
        <div class="row mt-3">
            <div class="box box-default" style="display: inline-block">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $products[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'category',
                            'type',
                            'measurement',
                            'compared',
                            'invalid',
                            'product_type_id',
                            'product_name',
                            'nd',
                            'nd_type',
                            'number_blank',
                            'number_reestr',
                            'date_from',
                            'date_to',
                        ],
                    ]); ?>

                    <div class="container-items">
                        <?php foreach ($products as $i => $stan):
                            $stan->category = PrimaryDataForm::CATEGORY_PRODUCT;
                            if ($i == 0) {
                                continue;
                            }
                            ?>
                            <div class="item panel panel-default item-product itemlar">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs" id="removeBtn"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 categoriya" style="display: none;">
                                            <?php
                                            echo $form->field($stan, "[{$i}]category")->dropDownList(PrimaryDataForm::categoryList()) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3 ">
                                            <?= $form->field($stan, "[{$i}]product_type_id")->dropDownList(ArrayHelper::map(ProductType::find()->all(), 'id', 'name')) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3 ">
                                            <?= $form->field($stan, "[{$i}]product_name")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-6  renderForm">
                                            <?php
                                            echo $this->render('_form_primary', [
                                                'form' => $form,
                                                'primaryIndex' => $i,
                                                'pro_primary' => !isset($pro_primary[$i]) ? [new ProPrimaryData] : $pro_primary[$i],
                                            ]) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3 ">
                                            <?= $form->field($stan, "[{$i}]nd_type")->dropDownList(ArrayHelper::map(NdType::find()->all(), 'id', 'name')) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <?= $form->field($stan, "[{$i}]number_blank")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <?= $form->field($stan, "[{$i}]number_reestr")->textInput() ?>
                                        </div>

                                        <div class="col-md-6 col-lg-2">
                                            <?= $form->field($stan, "[{$i}]date_from")->input('date') ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]date_to")->input('date') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'smt')->dropDownList([
                    0 => 'joriy etilgan',
                    1 => 'joriy etilmagan'
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'residue_quantity')->textInput() ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'residue_amount')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'potency')->textInput() ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'laboratory')->dropDownList(PrimaryData::getLab()) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'year_quantity')->textInput() ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'year_amount')->textInput() ?>
            </div>
        </div>

        <div class="col-12">
            <input type="submit" class="btn btn-info br-btn" value="Saqlash">
        </div>
        <?php ActiveForm::end() ?>

    </div>
    <script src="/js/jquery.js"></script>

<?php
$this->registerJs("	
	
	$('.dynamicform_wrapper').on('beforeInsert', function(e, item) {
	});
	var count =0
	$('.dynamicform_wrapper').on('afterInsert', function(e, item) {
        if($('.categoriya')[$('.categoriya').length-2].children[0].children[1].value=='2'){     
                console.log($('.categoriya')[$('.categoriya').length-2].children[0].children[1].value)
            var categories = $('.categoriya')[$('.categoriya').length-1].parentElement.children
 
            for(let i = 0; i<9; i++){
                if(i==0){
                categories[i].children[0].children[1].value='2'      
                 
                categories[i].children[0].children[1].style.display = 'none'    
               
                }else {
                categories[i].style.display = 'block'
                }		
            }
          
            for(let i =9 ;i<categories.length;i++){		
                 categories[i].style.display = 'none'                 
            }
            
        }
        //else {
//            for(let i = 0; i < 8; i++){
//                if(i==0){
//                categories[i].children[0].children[1].value='1'
//                categories[i].children[0].children[1].style.display = 'none'    
//                }else {         
//                categories[i].style.display = 'none'
//                }
//            }
//            for(let i =8 ;i<categories.length;i++){
//                categories[i].style.display = 'block'
//            }
    //    }
	
	});

	$('.dynamicform_wrapper').on('beforeDelete', function(e, item) {
		
	});

	$('.dynamicform_wrapper').on('afterDelete', function(e) {
		$('.dynamicform_wrapper .panel-title').each(function(index) {
			$(this).html('Стандарт: ' + (index + 1));
		});
	});
");
?>