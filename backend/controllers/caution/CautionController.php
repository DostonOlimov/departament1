<?php

namespace backend\controllers\caution;

use common\models\caution\InstructionSearch;
use common\models\caution\Instruction;
use yii\web\Controller;
use yii\filters\VerbFilter;

class CautionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new InstructionSearch(null);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('/caution/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('/caution/view', [
            'model' => Instruction::findOne($id),
        ]);
    }
}
