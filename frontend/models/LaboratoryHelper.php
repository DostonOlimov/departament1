<?php

namespace frontend\models;

class LaboratoryHelper
{
    public static function getForm($id, $attribute)
    {
//        die('erhget');
        $result = '<form style="width:auto;height:auto;color:black;margin:0;" method="post" action="/control/update-lab?id=' . $id . '&attribute=' . $attribute . '" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf-frontend" value="' . \Yii::$app->request->getCsrfToken() . '">
                    <input type="file" name=' .$attribute . '>
                    <button class="btn btn-success" type="submit">Saqlash</button>
                  </form>';
        return $result;

    }
}
