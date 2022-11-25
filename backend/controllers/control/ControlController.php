<?php

namespace backend\controllers\control;

use backend\controllers\profilactic\ASCII;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use common\models\control\InstructionUser;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOvSearch;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryProductSearch;
use common\models\Region;
use common\models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstructionController implements the CRUD actions for ControlInstruction model.
 */
class ControlController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'supervisor'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new InstructionSearch(null);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('/control/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('/control/view', [
            'model' => $model,
        ]);
    }

    public function actionDone($id)
    {
        $model = $this->findModel($id);

        $model->general_status = Instruction::GENERAL_STATUS_DONE;
        if ($model->save(false)) {
            return $this->redirect(['/control/control/view', 'id' => $id]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Instruction::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportForm()
    {
        $model = new \yii\base\DynamicModel([
            'begin_date' => '12/13/2021',
        ]);
        $model->addRule(['begin_date'], 'required');

        if (Yii::$app->request->post()) {
            $req = Yii::$app->request->post();
            $key = $req['DynamicModel']['begin_date'];
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

            $styleOne = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_THICK,
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

            $sheet->getRowDimension('1')->setRowHeight(20);
            $sheet->getRowDimension('4')->setRowHeight(30);
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(17);
            $sheet->getColumnDimension('C')->setWidth(27);
            $sheet->getColumnDimension('D')->setWidth(27);
            $sheet->getColumnDimension('E')->setWidth(14);
            $sheet->getColumnDimension('F')->setWidth(14);
            $sheet->getColumnDimension('G')->setWidth(11);
            $sheet->getColumnDimension('H')->setWidth(11);
            $sheet->getColumnDimension('I')->setWidth(11);
            $sheet->getColumnDimension('J')->setWidth(11);
            $sheet->getColumnDimension('K')->setWidth(0);
            $sheet->getColumnDimension('L')->setWidth(0);
            $sheet->getColumnDimension('M')->setWidth(15);
            $sheet->getColumnDimension('N')->setWidth(15);
            $sheet->getColumnDimension('S')->setWidth(15);
            $sheet->getColumnDimension('O')->setWidth(15);
            $sheet->getColumnDimension('P')->setWidth(15);
            $sheet->getColumnDimension('Q')->setWidth(15);
            $sheet->getColumnDimension('R')->setWidth(15);
            $sheet->getColumnDimension('T')->setWidth(15);
            $sheet->getColumnDimension('U')->setWidth(15);

            $sheet->getStyle('A1:U1')->applyFromArray($styleOne);
            $sheet->getStyle('A2:U4')->applyFromArray($styleArray);
            $sheet->setCellValue('A1', 'Давлат назорати департаменти томонидан 2021 йил давомида ўтказилган давлат назоратлари натижалари МАЪЛУМОТ');
            $sheet->mergeCells('A1:U1');
            $sheet->setCellValue('E2', 'Текширилган маҳсулот');
            $sheet->mergeCells('E2:F3');
            $sheet->setCellValue('G2', 'Шундан');
            $sheet->mergeCells('G2:J2');
            $sheet->setCellValue('G3', 'Стандартлаштириш қоидаларини бузилиши.');
            $sheet->mergeCells('G3:H3');
            $sheet->setCellValue('I3', 'Сертификатлаштириш қоидаларини бузилиши.');
            $sheet->mergeCells('I3:J3');
            $sheet->setCellValue('O2', 'Кўрилган чоралар');
            $sheet->mergeCells('O2:S2');
            $sheet->setCellValue('O3', 'Маъмурий жарима');
            $sheet->mergeCells('O3:P3');
            $sheet->setCellValue('Q3', 'Реализацияни таъқиқлаш');
            $sheet->mergeCells('Q3:R3');
            $sheet->setCellValue('S3', 'Фойдаланиш  таъқиқлаган ЎВ сони');
            $sheet->mergeCells('S3:S4');
            $sheet->setCellValue('T2', 'Username');
            $sheet->mergeCells('T2:T4');
            $sheet->setCellValue('U2', 'Inspektorlar');
            $sheet->mergeCells('U2:U4');


            $ASCII->excelASCII(79, 4, 4, 4, $sheet, [
                'Ф.И.О',
                'Суммаси. минг сўм',
                'Миқдори',
                'Суммаси. минг сўм'
            ]);

            $ASCII->excelASCII(75, 4, 2, 4, $sheet, [
                'Текширилган ЎВлари сони',
                'Давлат қиёсловидан ўтказилмаган ЎВлари сони',
                'Сифат назорати (лаборатория) холати',
                'СМТ жорий қилинганлик холати'
            ]);

            $ASCII->excelASCII(69, 6, 4, 4, $sheet, [
                'Миқдори',
                'Суммаси. минг сўм',
                'Миқдори',
                'Суммаси. минг сўм',
                'Миқдори',
                'Суммаси. минг сўм'
            ]);
            $ASCII->excelASCII(65, 4, 2, 4, $sheet, [
                '№',
                'Ҳудуд',
                'Корхона номи',
                'Маҳсулот номи'
            ]);

            $companiesGrupBy = Company::find()
                ->select(['control_companies.region_id as id', 'COUNT(control_companies.region_id) as count'])
                ->groupBy(['control_companies.region_id'])
                ->where(['>', 'control_companies.created_at', $startStr])
                ->andWhere(['<', 'control_companies.created_at', $endStr])
                ->asArray()
                ->all();

            $startColD = 5;
            $lab = '';
            $k = 1;
            foreach ($companiesGrupBy as $item => $key) {
                $startCol = $startColD;

                $regionName = Region::find()
                    ->select('name')
                    ->where(['regions.id' => $key['id']])
                    ->asArray()
                    ->one();

                $companies = Company::find()
                    ->where(['control_companies.region_id' => $key['id']])
                    ->asArray()
                    ->all();

                foreach ($companies as $x => $value) {
                    $startColC = $startColD;

                    $user_id = InstructionUser::find()
                        ->select('instruction_users.user_id as id')
                        ->where(['instruction_users.instruction_id' => $value['control_instruction_id']])
                        ->asArray()
                        ->all();

                    $user = User::find()->select('user.username as name')->where(['user.id' => $value['created_by']])->asArray()->one();
                    $defectData = Defect::find()
                        ->where(['control_defects.control_company_id' => $value['id']])
                        ->asArray()
                        ->one();

                    $measuresData = Measure::find()
                        ->where(['control_measures.control_company_id' => $value['id']])
                        ->asArray()
                        ->one();

                    $primaryData = PrimaryData::find()
                        ->where(['control_company_id' => $value['id']])
                        ->asArray()
                        ->one();

                    $primaryProductName = PrimaryProduct::find()
                        ->select('product_name as name')
                        ->where(['control_primary_product.control_primary_data_id' => $primaryData['id']])
                        ->asArray()
                        ->all();

                    if (!empty($primaryProductName)) {
                        foreach ($primaryProductName as $y => $p) {
                            $sheet->getRowDimension($startColD)->setRowHeight(20);
                            $sheet->setCellValue('D' . $startColD, $p['name']);
                            $sheet->mergeCells('D' . $startColD . ':D' . $startColD++);
                        }
                    } else {
                        $sheet->getRowDimension($startColD)->setRowHeight(20);
                        $startColD++;
                    }
                    $endColC = $startColD - 1;

                    $sheet->setCellValue('C' . $startColC, $value['name']);
                    $sheet->mergeCells('C' . $startColC . ':C' . $endColC);

                    $user_name = '';
                    if (!empty($user_id)) {
                        foreach ($user_id as $gg => $id) {
                            $username = User::find()
                                ->select('username')
                                ->where(['id' => $id['id']])
                                ->asArray()
                                ->one();

                            $user_name .= $username['username'] . " \n";
                        }

                    }
                    $sheet->setCellValue('U' . $startColC, $user_name);
                    $sheet->mergeCells('U' . $startColC . ':U' . $endColC);

                    $sheet->setCellValue('T' . $startColC, $user['name']);
                    $sheet->mergeCells('T' . $startColC . ':T' . $endColC);

                    $sheet->setCellValue('G' . $startColC, $defectData['tex_quantity']);
                    $sheet->mergeCells('G' . $startColC . ':G' . $endColC);

                    $sheet->setCellValue('H' . $startColC, $defectData['tex_cost']);
                    $sheet->mergeCells('H' . $startColC . ':H' . $endColC);

                    $sheet->setCellValue('I' . $startColC, $defectData['compliance_quantity']);
                    $sheet->mergeCells('I' . $startColC . ':I' . $endColC);

                    $sheet->setCellValue('J' . $startColC, $defectData['compliance_cost']);
                    $sheet->mergeCells('J' . $startColC . ':J' . $endColC);

                    $sheet->setCellValue('A' . $startColC, $k++);
                    $sheet->mergeCells('A' . $startColC . ':A' . $endColC);

                    $sheet->setCellValue('E' . $startColC, $primaryData['residue_quantity']);
                    $sheet->mergeCells('E' . $startColC . ':E' . $endColC);

                    $sheet->setCellValue('F' . $startColC, $primaryData['residue_amount']);
                    $sheet->mergeCells('F' . $startColC . ':F' . $endColC);

                    $t = '';
                    $tt = '';
                    if (!empty($measuresData['number_passport'])) {
                        $t = ' (';
                        $tt = ')';
                    }

                    $sheet->setCellValue('O' . $startColC, $measuresData['person'] . $t . $measuresData['number_passport'] . $tt);
                    $sheet->mergeCells('O' . $startColC . ':O' . $endColC);

                    $sheet->setCellValue('P' . $startColC, $measuresData['fine_amount']);
                    $sheet->mergeCells('P' . $startColC . ':P' . $endColC);

                    $sheet->setCellValue('Q' . $startColC, $measuresData['quantity']);
                    $sheet->mergeCells('Q' . $startColC . ':Q' . $endColC);

                    $sheet->setCellValue('R' . $startColC, $measuresData['amount']);
                    $sheet->mergeCells('R' . $startColC . ':R' . $endColC);

                    $sheet->setCellValue('S' . $startColC, $measuresData['ov_quantity']);
                    $sheet->mergeCells('S' . $startColC . ':S' . $endColC);

                    if ($primaryData['smt'] == 0) {
                        $smt = 'joriy etilgan';
                    }
                    if ($primaryData['smt'] == 1) {
                        $smt = 'joriy etilmagan';
                    }

                    $sheet->setCellValue('N' . $startColC, $smt);
                    $sheet->mergeCells('N' . $startColC . ':N' . $endColC);

                    if (isset($primaryData['laboratory'])) {
                        $lab = PrimaryData::getLab($primaryData['laboratory']);
                    }
                    $sheet->setCellValue('M' . $startColC, $lab);
                    $sheet->mergeCells('M' . $startColC . ':M' . $endColC);

                    if ($k % 2 == 0) {
                        $sheet->getStyle('C' . $startColC . ':U' . $endColC)->applyFromArray($ASCII->styleColor('DDEBF7'));
                        $sheet->getStyle('A' . $startColC . ':A' . $endColC)->applyFromArray($ASCII->styleColor('DDEBF7'));
                    }
                }
                $endCol = $startColD - 1;

                $sheet->setCellValue('B' . $startCol, $regionName['name']);
                $sheet->mergeCells('B' . $startCol . ':B' . $endCol);
            }
            $sheet->getStyle('A5:U' . --$startColD)->applyFromArray($styleBorder);

            $writer = new Xlsx($spreadsheet);
            $filename = 'Davlat nazorati.xlsx';
            $writer->save(\Yii::getAlias('@frontend') . '/web/excel/' . $filename);
            $this->redirect('/excel/' . $filename);
        }

        return $this->render('/control/export/export-form', [
            'model' => $model,
        ]);
    }
}
