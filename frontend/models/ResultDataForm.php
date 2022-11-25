<?php

namespace frontend\models;

use common\models\Nd;
use yii\base\Model;

class ResultDataForm extends Model
{
    public $nd_id;
    public $old_nd_id;
    public $comment_nd;
    public $comment_old_nd;

    public function rules()
    {
        return [
            [['nd_id', 'old_nd_id'], 'integer'],
            [['nd_id'], 'integer'],
            [['comment_nd', 'comment_old_nd'], 'string'],
            [['nd_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nd::className(), 'targetAttribute' => ['nd_id' => 'id']],
            [['old_nd_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nd::className(), 'targetAttribute' => ['old_nd_id' => 'id']],
        ];
    }
}
