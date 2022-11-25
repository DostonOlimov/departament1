<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class StepsProfilactic extends Widget
{

    public $pro_instruction_id;
    public $pro_company_id;

    public function run()
    {
//        VarDumper::dump($this->instruction_id);die;
        return $this->render('sidebar_profilactic',[
            'pro_instruction_id' => $this->pro_instruction_id,
            'pro_company_id' => $this->pro_company_id,
        ]);
    }

}
