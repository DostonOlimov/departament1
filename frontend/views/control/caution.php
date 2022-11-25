<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Caution */


use common\models\control\Caution;
use common\models\control\Company;
use frontend\widgets\Steps;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => Company::findOne($company_id)->control_instruction_id,
        'control_company_id' => $company_id,
    ]) ?>

    <?php $form = ActiveForm::begin([
//        'enableClientValidation' => false,
//        'enableAjaxValidation' => true,
//        'validateOnChange' => true,
//        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]) ?>


    <div class="row">
        <div class="box box-default" style="display: inline-block">
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                        'limit' => 3, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $model[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'file',
                        'caution_number',
                        'caution',
                        'file',
                        'caution_date',
                        'description',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($model as $i => $stan): ?>
                        <div class="item panel panel-default item-product"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                                class="fa fa-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="fa fa-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 types">
                                        <?= $form->field($stan, "[{$i}]caution")->dropDownList(Caution::getType(), ['prompt' => '- - -']) ?>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <?= $form->field($stan, "[{$i}]file")->input('file') ?>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <?= $form->field($stan, "[{$i}]caution_number")->textInput() ?>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <?= $form->field($stan, "[{$i}]caution_date")->input('date') ?>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <?= $form->field($stan, "[{$i}]description")->textarea() ?>
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

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>


<?php
$this->registerJs("	
var lastSelected = [];
 var s =0, a, b;
	$('.dynamicform_wrapper').on('beforeInsert', function(e, item) {
	if(s==0){
	console.log('1 chidagi')
	}
	});   

 
	$('.dynamicform_wrapper').on('afterInsert', function(e, item) {
	
	let options = document.querySelectorAll('.types')
	let count = e.target.children[0].childElementCount
	let items = e.target.children[0].children
	console.log(s)

    if(s==0){
    for(let i=1; i < 4; i++){             
          if(options[options.length-2].children[0].children[1].children[i].selected){        
                options[options.length-1].children[0].children[1].children[i].style.display='none'
                a = options[options.length-1].children[0].children[1].children[i].value
        }    
          if(options[0].children[0].children[1].children[i].selected !==true){
                options[0].children[0].children[1].children[i].style.display = 'none'
         }
    }
    }else if(s==1){    
            for(let i=1; i < 4; i++){             
                  if(options[options.length-2].children[0].children[1].children[i].selected || options[options.length-2].children[0].children[1].children[i].value ==a){        
                        options[options.length-1].children[0].children[1].children[i].style.display='none'                
                }       
            }
    }
    s=s+1
   

              
              
	console.log('Added:'+e.target.children[0].childElementCount)
	console.log(e.target.children[0].children)
	console.log(options)
	
	
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
