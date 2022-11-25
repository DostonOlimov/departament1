<?php

namespace backend\controllers\profilactic;


use common\models\Countries;
use common\models\profilactic\AnswerCountry;
use common\models\profilactic\ResultCountry;

class ASCII
{
    public function excelASCII($startASCII, $son, $startRow, $endRow, $sheet, $value=[])
    {

        if ($startASCII > 90)
        {
            $one = chr((int)($startASCII / 100));
            $startASCII = $startASCII % 100;
        }else{
            $one = '';
        }
        $j = 0;

        for ($i = 0; $i < $son; $i++)
        {
            if ($startASCII > 90){
                $startASCII = 65;
                if ($one === 'A')
                    $one = 'B';
                if ($one === '')
                    $one = 'A';
            }

            if (empty($value[$j]))
                $value[$j] = '';

            $sheet->setCellValue($one.chr($startASCII) . $startRow, $value[$j++]);
            $sheet->mergeCells($one.chr($startASCII) . $startRow . ':' . $one.chr($startASCII) . $endRow);
            $startASCII++;
        }
    }

    public function styleColor($rgb)
    {
        return [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => $rgb]
            ],
        ];
    }

    public function CountryName($pro_result_id){
        $c_id = ResultCountry::find()
            ->select('pro_results_countries.country_id')
            ->where(['pro_results_countries.pro_result_id' => (int)$pro_result_id])
            ->asArray()
            ->all();

        $name = '';
        foreach ($c_id as $x => $key){

            $countris_name = Countries::find()
                ->select('countries.name as c_name')
                ->where(['countries.id' => $key['country_id']])
                ->asArray()
                ->one();

            $name .= $countris_name['c_name'] . "\n";
        }
        return $name;
    }

    public function CountryNameAns($pro_answer_id){
        $c_id = AnswerCountry::find()
            ->select(['pro_answer_countries.country_id as country_id', 'pro_answer_countries.import_export as im_ex'])
            ->where(['pro_answer_countries.pro_answer_id' => (int)$pro_answer_id])
            ->asArray()
            ->all();

        $im = '';   $ex = '';
        foreach ($c_id as $x => $key){
            $countris_name = Countries::find()
                ->select('countries.name as c_name')
                ->where(['countries.id' => $key['country_id']])
                ->asArray()
                ->one();

            if ($key['im_ex'] === 'import'){
                $im .= $countris_name['c_name'] . "\n";
            }

            if ($key['im_ex'] === 'export'){
                $ex .= $countris_name['c_name'] . "\n";
            }
        }
        return [
            'ex' => $ex,
            'im' => $im,
        ];
    }
}
