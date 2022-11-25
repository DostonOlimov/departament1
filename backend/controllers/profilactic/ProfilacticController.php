<?php

namespace backend\controllers\profilactic;

use common\models\Countries;
use common\models\Nd;
use common\models\profilactic\Answer;
use common\models\profilactic\AnswerCountry;
use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\Company;
use common\models\profilactic\InstructionSearch;
use common\models\profilactic\Instruction;
use common\models\profilactic\Result;
use common\models\profilactic\ResultCountry;
use common\models\profilactic\ResultNd;
use common\models\profilactic\ResultOldNd;
use common\models\ProgramType;
use common\models\Region;
use common\models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ProfilacticController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new InstructionSearch(null);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('/profilactic/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('/profilactic/view', [
            'model' => Instruction::findOne($id),
        ]);
    }

    public function actionDone($id)
    {
        $model = Instruction::findOne($id);

        $model->general_status = Instruction::GENERAL_STATUS_DONE;
        if ($model->save(false)) {
            return $this->redirect(['/profilactic/profilactic/view', 'id' => $id]);
        }
    }

    public function actionExportForm()
    {
        $model = new \yii\base\DynamicModel([
            'begin_date' => '12/13/2021',
        ]);
        $model->addRule(['begin_date'], 'required');

        if (Yii::$app->request->post()) {
            $value = Yii::$app->request->post();
            $key = $value['DynamicModel']['begin_date'];
            $startStr = Yii::$app->formatter->asTimestamp(substr($key, 0, 10));
            $endStr = Yii::$app->formatter->asTimestamp(substr($key, 13));

            $ASCII = new ASCII();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => '000000'
                        ]
                    ]
                ],
            ];

            $styleBorder = [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => '000000'
                        ]
                    ]
                ],
            ];

            /*
             *  demo style width, height and auto
             * */
//            $objWorksheet->getActiveSheet()->getColumnDimension('A')->setWidth(100);
//            $sheet->getColumnDimension('F')->setAutoSize(true);
//            $objWorksheet->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

            $startASCII = 65; $one = '';

            for ($t = 0; $t < 68; $t++){
                if ($startASCII > 90){
                    $startASCII = 65;
                    if ($one === 'A')
                        $one = 'B';
                    if ($one === '')
                        $one = 'A';
                }
                if ($startASCII == 70){
                    $sheet->getColumnDimension($one.chr($startASCII))->setWidth(14);
                }else {
                    $sheet->getColumnDimension($one . chr($startASCII))->setWidth(13);
                }

                $startASCII++;
            }

            $sheet->getRowDimension('1')->setRowHeight(55);
            $sheet->getRowDimension('2')->setRowHeight(55);
            $sheet->getRowDimension('3')->setRowHeight(55);
            $sheet->getColumnDimension('A')->setWidth(13);
            $sheet->getStyle('A1:BR3')->applyFromArray($styleArray);
            $sheet->getStyle('N1:AE3')->applyFromArray($ASCII->styleColor('F4B084'));
            $sheet->getStyle('AF1:AH3')->applyFromArray($ASCII->styleColor('8497B0'));
            $sheet->getStyle('AI1:AK3')->applyFromArray($ASCII->styleColor('AEAAAA'));
            $sheet->getStyle('AL1:AN3')->applyFromArray($ASCII->styleColor('FFD966'));
            $sheet->getStyle('AO1:AQ3')->applyFromArray($ASCII->styleColor('8EA9DB'));
            $sheet->getStyle('AR1:BD3')->applyFromArray($ASCII->styleColor('A9D08E'));
            $sheet->getStyle('BE1:BH3')->applyFromArray($ASCII->styleColor('FFF2CC'));
            $sheet->getStyle('BI1:BK3')->applyFromArray($ASCII->styleColor('E2EFDA'));

            $ASCII->excelASCII(65, 13, 1, 3, $sheet, [
                '№',
                'СТИР',
                'Корхона номи',
                'Манзили',
                'Тел рақами',
                'Профилактика ўтказиш усули (Онлайн / жойига чиққан ҳолда)',
                'Қайси давлат дастурига киритилган, қарор ёки лойиҳа номи',
                'Профилактика асоси',
                'Хусусий юридик субъекти',
                'Соҳа номи',
                'И/Ч махсулот номи',
                'Корхона ходимларининг малакаси оширилганлиги',
                'Махсулот сифати оргонолептика'
            ]);

            $sheet->setCellValue('N1', 'Корхонада фойдаланилаётган меъёрий хужжатлар сони');
            $sheet->mergeCells('N1:AE1');

            $sheet->setCellValue('AF1', 'Мувофиқлик сертификати');
            $sheet->mergeCells('AF1:AH1');

            $sheet->setCellValue('AI1', 'Улчов воситалари');
            $sheet->mergeCells('AI1:AK1');

            $sheet->setCellValue('AL1', 'Синов лабораторияси');
            $sheet->mergeCells('AL1:AN1');

            $sheet->setCellValue('AO1', 'Мавжуд камчилик ва муаммолар');
            $sheet->mergeCells('AO1:AQ1');

            $sheet->setCellValue('AR1', 'Кўрсатилган амалий ёрдам');
            $sheet->mergeCells('AR1:BC1');

            $sheet->setCellValue('BD1', 'Корхонанинг муаммо ва таклифлари');
            $sheet->mergeCells('BD1:BD3');

            $sheet->setCellValue('BE1', 'Экспортёр давлат (ва махсулот номи)');
            $sheet->mergeCells('BE1:BF3');

            $sheet->setCellValue('BG1', 'Импортёр давлат (ва махсулот номи)');
            $sheet->mergeCells('BG1:BH3');

            $sheet->setCellValue('BI1', 'Халқаро');
            $sheet->mergeCells('BI1:BK1');

            $ASCII->excelASCII(6676, 7, 1, 3, $sheet, [
                'Профилактика ўтказган масъул ҳодим',
                'Департамен масъул ҳодими',
                'Профилактика утказилган худуд',
                'Хужжат санаси',
                'Хужжат номери',
                'Holati',
                'Profilaktika tugagan sana',
            ]);

            $sheet->setCellValue('N2', '1980-90 йиллар');
            $sheet->mergeCells('N2:S2');

            $sheet->setCellValue('T2', '1990-2000 йиллар');
            $sheet->mergeCells('T2:Y2');

            $sheet->setCellValue('Z2', '2000-21 йиллар');
            $sheet->mergeCells('Z2:AE2');

            $ASCII->excelASCII(6570, 12, 2, 3, $sheet, [
                'Сертификатлаштириш органи номи',
                'Реестр рақами',
                'амал қилиш муддати',
                'Жами ўлчов воситалари',
                'Қиёслаш муддати ўтган ўлчов воситалари',
                'Қиёсловдан ўтмаган ўлчов воситалари',
                'Мавжуд',
                'Шартнома асосида',
                'Мавжуд эмас',
                'Стандарт',
                'Сертификат',
                'Метрология'
            ]);

            $sheet->setCellValue('AR2', 'Стандарт');
            $sheet->mergeCells('AR2:AT2');

            $sheet->setCellValue('AU2', 'СМТ жорий этиш');
            $sheet->mergeCells('AU2:AU3');

            $sheet->setCellValue('AV2', 'Сертификат');
            $sheet->mergeCells('AV2:AV3');

            $sheet->setCellValue('AW2', 'Метрология');
            $sheet->mergeCells('AW2:AX2');

            $sheet->setCellValue('AY2', 'Импортга амалий ёрдам');
            $sheet->mergeCells('AY2:AZ2');

            $sheet->setCellValue('BA2', 'Экспортга амалий ёрдам');
            $sheet->mergeCells('BA2:BB2');

            $sheet->setCellValue('BC2', 'Сохага оид конун ва карорлар билан таништириш');
            $sheet->mergeCells('BC2:BC3');


            $sheet->setCellValue('BI2', 'Маҳсулот ва синов учун стандарт');
            $sheet->mergeCells('BI2:BI3');
            $sheet->setCellValue('BJ2', 'СМТ жорий этилганлиги');
            $sheet->mergeCells('BJ2:BJ3');
            $sheet->setCellValue('BK2', 'Маҳсулот учун сертификат олинганлиги.');
            $sheet->mergeCells('BK2:BK3');

            $ASCII->excelASCII(78, 18, 3, 3, $sheet, [
                'Халкаро стандартлар',
                'Минтакавий стандартлар',
                'Давлатлараро стандартлар',
                'Миллий стандартлар',
                'Ташкилот стандартлари',
                'Техник шартлар',
                'Халкаро стандартлар',
                'Минтакавий стандартлар',
                'Давлатлараро стандартлар',
                'Миллий стандартлар',
                'Ташкилот стандартлар',
                'Техник шартлар',
                'Халкаро стандартлар',
                'Минтакавий стандартлар',
                'Давлатлараро стандартлар',
                'Миллий стандартлар',
                'Ташкилот стандартлари',
                'Техник шартлар'
            ]);

            $ASCII->excelASCII(6582, 3, 3, 3, $sheet, [
                'стандарт тақдим қилиш (жорий этиш)',
                'Актуаллаштириш',
                'Халкаро стандарт жорий этиш'
            ]);

            $ASCII->excelASCII(6587, 6, 3, 3, $sheet, [
                'Сони',
                'Номи',
                'Давлат',
                'Изох',
                'Давлат',
                'Изох'
            ]);

            $rowsDis = Company::find()
                ->select(['disorders.company_id as com_id', 'disorders.standart', 'disorders.certificate', 'disorders.metrologic'])
                ->innerJoin('disorders', 'pro_companies.id = disorders.company_id')
                ->asArray()
                ->all();

            $rowsIns = Instruction::find()
                ->select([
                    'pro_instructions.id as 104',
                    'pro_instructions.program_type as 102',
                    'pro_companies.inn as 1',
                    'pro_companies.name as 2',
                    'pro_companies.address as 3',
                    'pro_companies.phone as 4',
                    'pro_instructions.status as 5',
                    'pro_instructions.base as 7',
                    'pro_instructions.subject as 8',
                    'pro_companies.region_id as 40',
                    'pro_instructions.letter_date as date_time',
                    'pro_instructions.letter_number as 67',
                    'pro_companies.region_id as reg_id',
                    'pro_instructions.created_by as user',
                    'pro_instructions.general_status as g_status',
                    'pro_instructions.updated_at as end_date'
                ])
                ->innerJoin('pro_companies', 'pro_instructions.id = pro_companies.pro_instruction_id')
                ->where(['>', 'pro_instructions.created_at', $startStr])
                ->andWhere(['<', 'pro_instructions.created_at', $endStr])
                ->orderBy(['pro_instructions.id' => SORT_DESC])
                ->asArray()
                ->all();

            $k = 1;
            foreach ($rowsIns as $x => $val) {

                $val[63] = User::find()
                    ->select('username')
                    ->where(['user.id' => $val['user']])
                    ->asArray()
                    ->one()['username'];

                $programType = ProgramType::find()
                    ->select('program_types.name as 6')
                    ->where(['program_types.id' => $val[102]])
                    ->asArray()
                    ->one();

                $val[6] = $programType[6];

                $rowsCom = Company::find()
                    ->select([
                        'pro_companies.pro_instruction_id as 103',
                        'pro_results.id as 101',
                        'pro_results.smk as smt',
                        'pro_results.smk_text as smt_txt',
                        'pro_companies.region_id as 62',
                        'pro_results.problem as 55',
                        'pro_results.people as 64',
                        'pro_results.decision_text as decision_text',
                        'pro_results.decision as decision',
                        'pro_results.import_export_text as im_ex_text',
                        'pro_results.import_export as im_ex',
                    ])
                    ->innerJoin('pro_results', 'pro_companies.id = pro_results.pro_company_id')
                    ->where(['pro_companies.pro_instruction_id' => $val[104]])
                    ->asArray()
                    ->all();

                $rowsComIJ = Company::find()
                    ->select([
                        'pro_answers.id as 100',
                        'pro_answers.field_name as 9',
                        'pro_answers.product_name as 10',
                        'pro_answers.employee as 11',
                        'pro_answers.product_quality as 12',
                        'pro_answers.organization_name as 31',
                        'pro_answers.reestr_number as 32',
                        'pro_answers.validity_period as 33',
                        'pro_answers.all_instruments as 34',
                        'pro_answers.expired_instruments as 35',
                        'pro_answers.not_expired_instruments as 36',
                        'pro_answers.lab_check as 37',
                        'pro_answers.internation_standard as 45',
                        'pro_answers.smk as 46',
                        'pro_answers.organization_name as or_name',
                        'pro_answers.reestr_number as res_number',
                        'pro_answers.validity_period as val_per',
                        'pro_answers.import_product as 59',
                        'pro_answers.export_product as 57',
                    ])
                    ->innerJoin('pro_answers', 'pro_companies.id = pro_answers.pro_company_id')
                    ->where(['pro_companies.pro_instruction_id' => $val[104]])
                    ->asArray()
                    ->all();

                if (isset($rowsCom[0])) {
                    $val += $rowsCom[0];
                }
                if (isset($rowsComIJ[0])) {
                    $val += $rowsComIJ[0];
                }

                $val[66] = $val['date_time'] ? Yii::$app->formatter->asDate($val['date_time'], 'M/dd/yyyy') : '';

                $reg_name = Region::find()
                    ->select('name as reg_name')
                    ->where(['regions.id' => $val['reg_id']])
                    ->asArray()
                    ->one();

                $val[65] = $reg_name['reg_name'];

                if (isset($val[100])){
                    $im_ex = $ASCII->CountryNameAns($val[100]);
                    $val[56] = $im_ex['ex'];
                    $val[58] = $im_ex['im'];
                }

                $val[61] = (isset($val['smt']) && $val['smt'] == 1) ? "Yordam berildi\n" . $val['smt_txt'] : ((isset($val['smt']) && $val['smt'] == 0) ? 'Yordam berilmadi' : '');
                $val[54] = (isset($val['decision']) && $val['decision'] == 1) ? "Yordam berildi\n" . $val['decision_text'] : ((isset($val['decision']) && $val['decision'] == 0) ? 'Yordam berilmadi' : '');


                if (isset($val['im_ex']) && $val['im_ex'] == 0){
                    $val[51] = $val['im_ex_text'];
                    $countris_name = $ASCII->CountryName($val[101]);
                    $val[50] = $countris_name;
                }
                if (isset($val['im_ex']) && $val['im_ex'] == 1){
                    $val[53] = $val['im_ex_text'];
                    $countris_name = $ASCII->CountryName($val[101]);
                    $val[52] = $countris_name;
                }
			
                $val[47] = isset($val['or_name']) ? $val['or_name'] : ' ' . "\n" . (isset($val['res_number']) ? $val['res_number'] : ' ') . "\n" . (isset($val['val_per']) ? $val['val_per'] : ' ');

                $resultNds = ResultNd::find()
                    ->select(['result_nds.description as des', 'result_nds.id', 'result_nds.nd_id'])
                    ->where(['result_nds.result_id' => isset($val[101]) ? $val[101] : null])
                    ->asArray()
                    ->all();

                if (isset($resultNds)) {
                    foreach ($resultNds as $t => $qiy) {
                        $Nd = new Nd();
                        $NdName = $Nd->OneToOne($qiy['nd_id'])['name'];

                        $val[44] .= $NdName . ' -> ' . $qiy['des'];

                        $resultOldNds = ResultOldNd::find()
                            ->select(['result_old_nds.description as des', 'result_old_nds.nd_id'])
                            ->where(['result_old_nds.result_nd_id' => $qiy['id']])
                            ->asArray()
                            ->all();

                        foreach ($resultOldNds as $hh => $j) {
                            $NdOldName = $Nd->OneToOne($j['nd_id'])['name'];
                            $val[44] .= '( ' . $NdOldName . ' -> ' . $j['des'] . ') ';
                        }
                        $val[44] .= "\n";
                    }
                }

                $yy = 0;
                foreach ($rowsDis as $h => $keys) {
                    if (isset($val[100]) && $val[100] === $keys['com_id']) {
                        $val[40] = $keys['standart'];
                        $val[41] = $keys['certificate'];
                        $val[42] = $keys['metrologic'];
                        $yy++;
                    }
                }
                if (!$yy) {
                    $val[40] = '';
                    $val[41] = '';
                    $val[42] = '';
                }

                if (isset($val[37]) && strlen($val[37]) > 2) {
                    $val[37] = Answer::labList(1);
                    $val[38] = Answer::labList(2);
                } else {
                    if (isset($val[37]) && strlen($val[37]) == 1) {
                        switch ($val[37]) {
                            case 1:
                                $val[37] = Answer::labList($val[37]);
                                break;
                            case 2:
                                $val[38] = Answer::labList($val[37]);
                                $val[37] = '';
                                break;
                            case 3:
                                $val[39] = Answer::labList($val[37]);
                                $val[37] = '';
                                break;
                        }
                    } else
                        $val[37] = '';
                }

                $rowsAns = Answer::find()
                    ->select([
                        'pro_answer_standard_counts.name as name',
                        'pro_answer_standard_counts.type as type',
                        'pro_answer_standard_counts.category as category'])
                    ->innerJoin('pro_answer_standard_counts', 'pro_answers.id = pro_answer_standard_counts.pro_answer_id')
                    ->where(['pro_answer_standard_counts.pro_answer_id' => isset($val[100]) ? $val[100] : null])
                    ->asArray()
                    ->all();

                for ($rr = 13; $rr < 31; $rr++){
                    $val[$rr] = '';
                }

                foreach ($rowsAns as $r => $key) {

                    switch ($key['type']) {
                        case AnswerStandardCount::TYPE_EIGHTY:
                            switch ($key['category']) {
                                case 0:
                                    $val[13] .= $key['name'] . "\n";
                                    break;
                                case 1:
                                    $val[15] .= $key['name'] . "\n";
                                    break;
                                case 2:
                                    $val[16] .= $key['name'] . "\n";
                                    break;
                                case 3:
                                    $val[17] .= $key['name'] . "\n";
                                    break;
                            }
                            break;
                        case AnswerStandardCount::TYPE_NINETY:
                            switch ($key['category']) {
                                case 0:
                                    $val[19] .= $key['name'] . "\n";
                                    break;
                                case 1:
                                    $val[21] .= $key['name'] . "\n";
                                    break;
                                case 2:
                                    $val[22] .= $key['name'] . "\n";
                                    break;
                                case 3:
                                    $val[23] .= $key['name'] . "\n";
                                    break;
                            }
                            break;
                        case AnswerStandardCount::TYPE_ZERO:
                            switch ($key['category']) {
                                case 0:
                                    $val[25] .= $key['name'] . "\n";
                                    break;
                                case 1:
                                    $val[27] .= $key['name'] . "\n";
                                    break;
                                case 2:
                                    $val[28] .= $key['name'] . "\n";
                                    break;
                                case 3:
                                    $val[29] .= $key['name'] . "\n";
                                    break;
                            }
                            break;
                    }

                }

                $val[0] = $k++;
                if (!isset($val[5]))
                    $val[5] = '';
                else
                    $val[5] = Instruction::getStatus($val[5]);
                if (!isset($val[7]))
                    $val[7] = '';
                else
                    $val[7] = Instruction::getType($val[7]);
                if (!isset($val[8]))
                    $val[8] = '';
                else
                    $val[8] = Instruction::getSubject($val[8]);

                $company = Company::findOne(['pro_instruction_id' => $val[104]]);
		$val[9] = '';
                if ($company && $company->answer && $company->answer->productType) {
                    $val[9] = $company->answer->productType->name;
		}

                if ($val['g_status']){
                    $val[68] = Instruction::getGeneralStatus($val['g_status']);
                }

                $val[69] = '';
                if ($val['g_status'] == Instruction::GENERAL_STATUS_DONE){
                    $val[69] = Yii::$app->formatter->asDate($val['end_date'], 'M/dd/yyyy');
                }

                $ASCII->excelASCII(65, 70, $k + 2, $k + 2, $sheet, $val);

                $n = $k + 2;
                $sheet->getStyle('A' . $n . ':BR' . $n)->applyFromArray($styleBorder);
                if ($k % 2 == 0){
                    $sheet->getStyle('A'. $n .':BR' . $n)->applyFromArray($ASCII->styleColor('DDEBF7'));
                }
            }

            $writer = new Xlsx($spreadsheet);
            $filename = 'profilaktika.xlsx';
            $writer->save(\Yii::getAlias('@frontend') . '/web/excel/' . $filename);
            $this->redirect('/excel/' . $filename);
        }

        return $this->render('/profilactic/export/export-form', [
            'model' => $model,
        ]);
    }

    public function actionExport()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $styleArray = ['font' => ['bold' => true]];
        $sheet->getStyle('A1:AB1')->applyFromArray($styleArray);

        $maxDate = Instruction::find()->max('created_at');
        $minDate = Instruction::find()->min('created_at');

        $title = Yii::$app->formatter->asDate($minDate) . ' dan ' . Yii::$app->formatter->asDate($maxDate) . ' gacha amalga oshirilgan prifilaktika ishlari(hududlar kesimida).';

        $sheet->setCellValue('A1', $title);
        $sheet->mergeCells('A1:Z1');
        $sheet->setCellValue('A2', '№');
        $sheet->mergeCells('A2:A3');
        $sheet->setCellValue('B2', 'Korxona nomi');
        $sheet->mergeCells('B2:B3');
        $sheet->setCellValue('C2', 'Profilaktika o\'tkazish usuli(masofaviy/joyiga chiqqan holda)');
        $sheet->mergeCells('C2:C3');
        $sheet->setCellValue('D2', 'Viloyat yoki shahar');
        $sheet->mergeCells('D2:D3');
        $sheet->setCellValue('E2', 'Yurudik manzil');
        $sheet->mergeCells('E2:E3');
        $sheet->setCellValue('F2', 'I/CH maxsulot nomi');
        $sheet->mergeCells('F2:F3');
        $sheet->setCellValue('G2', 'Maxalliylashtirish darajasi');
        $sheet->mergeCells('G2:G3');
        $sheet->setCellValue('H2', 'Qaysi davlat dasturiga kiritilgan, qaror yoki loyiha nomi');
        $sheet->mergeCells('H2:H3');
        $sheet->setCellValue('I2', 'Soha nomi');
        $sheet->mergeCells('I2:I3');
        $sheet->setCellValue('J2', 'Korxona xodimlarining malakasi oshirilganligi');
        $sheet->mergeCells('J2:J3');

        $sheet->setCellValue('K2', 'Korxonada foydalanilayotgan me`yoriy hujjatlar belgilanishi');
        $sheet->mergeCells('K2:M2');
        $sheet->setCellValue('K3', '1980-1990 yillar');
        $sheet->setCellValue('L3', '1990-2000 yillar');
        $sheet->setCellValue('M3', '2000-2021 yillar');

        $sheet->setCellValue('N2', 'Mavjud kamchilik va muammolar');
        $sheet->mergeCells('N2:P2');
        $sheet->setCellValue('N3', 'Standart');
        $sheet->setCellValue('O3', 'Sertifikat');
        $sheet->setCellValue('P3', 'Metrologiya');

        $sheet->setCellValue('Q2', 'Ko\'rsatilgan amaliy yordam');
        $sheet->mergeCells('Q2:S2');
        $sheet->setCellValue('Q3', 'Standart');
        $sheet->setCellValue('R3', 'Sertifikat');
        $sheet->setCellValue('S3', 'Metrologiya');

        $sheet->setCellValue('T2', 'Eksportyor(davlat va mahsulot nomi)');
        $sheet->mergeCells('T2:T3');
        $sheet->setCellValue('U2', 'Importyor(davlat va mahsulot nomi)');
        $sheet->mergeCells('U2:U3');

        $sheet->setCellValue('V2', 'Xalqaro');
        $sheet->mergeCells('V2:X2');
        $sheet->setCellValue('V3', 'Maxsulot va sinov uchun standart');
        $sheet->setCellValue('W3', 'SMT joriy etilganligi');
        $sheet->setCellValue('X3', 'Maxsulot uchun sertifikat olinganligi');

        $sheet->setCellValue('Y2', 'Sinov laboratoriyasi');
        $sheet->mergeCells('Y2:Y3');
        $sheet->setCellValue('Z2', 'Profilaktika o\'tkazgan mas`ul xodim');
        $sheet->mergeCells('Z2:Z3');

        $models = Instruction::find()->all();

        $i = 4;
        foreach ($models as $model) {
            /* @var $model Instruction */

            $sheet->setCellValue('A' . $i, $i - 3);
            $sheet->setCellValue('B' . $i, $model->company ? $model->company->name : '');
            $sheet->setCellValue('C' . $i, 'Masofaviy');
            $sheet->setCellValue('D' . $i, $model->company ? $model->company->region->name : '');
            $sheet->setCellValue('E' . $i, $model->company ? $model->company->address : '');
            $sheet->setCellValue('F' . $i, $model->company ? ($model->company->answer ? $model->company->answer->product_name : '') : '');
//            $sheet->setCellValue('G' . $i, $model->company ? ($model->company->answer ? $model->company->answer->level : '') : '');
            $sheet->setCellValue('H' . $i, '');
            $sheet->setCellValue('I' . $i, '');
            $sheet->setCellValue('J' . $i, $model->company ? ($model->company->answer ? $model->company->answer->employee : '') : '');
            if ($model->company) {
                if ($model->company->answer) {
                    $ansDocs = AnswerStandardCount::find()->where(['pro_answer_id' => $model->company->answer->id])->all();
                    if ($ansDocs) {
                        $textK = '';
                        $textL = '';
                        $textM = '';
                        foreach ($ansDocs as $doc) {
                            if ($doc->type == AnswerStandardCount::TYPE_EIGHTY) {
                                $textK .= $doc->name . PHP_EOL;
                            } else if ($doc->type == AnswerStandardCount::TYPE_NINETY) {
                                $textL .= $doc->name . PHP_EOL;
                            } else {
                                $textM .= $doc->name . PHP_EOL;
                            }
                        }
                        $sheet->setCellValue('K' . $i, $textK);
                        $sheet->setCellValue('L' . $i, $textL);
                        $sheet->setCellValue('M' . $i, $textM);
                    }


                    $ansCountries = AnswerCountry::find()->where(['pro_answer_id' => $model->company->answer->id])->all();
                    if ($ansCountries) {
                        $countryProduct = '';
                        foreach ($ansCountries as $country) {
                            /**@var $country AnswerCountry */
                            $countryProduct .= $country->country->name . ', ';
                        }

                        if ($model->company->answer->import_export) {
                            $sheet->setCellValue('T' . $i, 'Davlatlar: ' . $countryProduct . PHP_EOL . $model->company->answer->import_export_product);
                        } else {
                            $sheet->setCellValue('U' . $i, 'Davlatlar: ' . $countryProduct . PHP_EOL . $model->company->answer->import_export_product);
                        }
                    }
                }
            }

            $setYCol = '';
            if ($model->company) {
                if ($model->company->answer) {
                    if ($model->company->answer->lab_check) {
                        foreach (explode(',', $model->company->answer->lab_check) as $lab) {
                            $setYCol .= Answer::labList($lab) . PHP_EOL;
                        }
                    }
                }
            }

            $sheet->setCellValue('N' . $i, '');
            $sheet->setCellValue('O' . $i, '');
            $sheet->setCellValue('P' . $i, '');
            $sheet->setCellValue('Q' . $i, '');
            $sheet->setCellValue('R' . $i, '');
            $sheet->setCellValue('S' . $i, '');
            $sheet->setCellValue('V' . $i, $model->company ? ($model->company->answer ? $model->company->answer->internation_standard : '') : '');
            $sheet->setCellValue('W' . $i, $model->company ? ($model->company->answer ? $model->company->answer->smk : '') : '');
            $sheet->setCellValue('X' . $i, $model->company ? ($model->company->answer ? $model->company->answer->international_certificate : '') : '');
            $sheet->setCellValue('Y' . $i, $setYCol);
            $sheet->setCellValue('Z' . $i, $model->created_by ? $model->createdBy->username : '');


            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'profilaktika.xlsx';
//die(\Yii::getAlias('@frontend'));
        $writer->save(\Yii::getAlias('@frontend') . '/web/excel/' . $filename);
        $this->redirect('/excel/' . $filename);
    }
}
