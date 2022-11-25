<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class StepsShopping extends Widget
{

    public $shopping_instruction_id;
    public $shopping_company_id;

    public function run()
    {
//        VarDumper::dump($this->instruction_id);die;
        return $this->render('sidebar_shopping',[
            'shopping_instruction_id' => $this->shopping_instruction_id,
            'shopping_company_id' => $this->shopping_company_id,
        ]);
    }

}
