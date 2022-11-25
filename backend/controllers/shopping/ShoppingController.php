<?php

namespace backend\controllers\shopping;

use common\models\shopping\InstructionSearch;
use common\models\shopping\Instruction;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ShoppingController extends Controller
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

        return $this->render('/shopping/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('/shopping/view', [
            'model' => Instruction::findOne($id),
        ]);
    }
}
