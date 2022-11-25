<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class Steps extends Widget
{

    public $control_instruction_id;
    public $control_company_id;

    public function run()
    {
        return $this->render('sidebar',[
            'control_instruction_id' => $this->control_instruction_id,
            'control_company_id' => $this->control_company_id,
        ]);
    }

}
