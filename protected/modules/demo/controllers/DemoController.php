<?php
namespace app\modules\demo\controllers;

use Yii;
use app\components\Controller;
use pgc\helpers\ResponseHelper;

class DemoController extends Controller
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $uid = Yii::$app->user->getId();
        $data = [
            'uid' => $uid,
        ];
        ResponseHelper::outputJsonV2($data);
    }
}
