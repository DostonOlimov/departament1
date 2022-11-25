<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class StepsCautions extends Widget
{

    public $caution_instruction_id;
    public $caution_company_id;

    public function run()
    {
//        VarDumper::dump($this->instruction_id);die;
        return $this->render('sidebar_cautions',[
            'caution_instruction_id' => $this->caution_instruction_id,
            'caution_company_id' => $this->caution_company_id,
        ]);
    }

}
