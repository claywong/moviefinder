<?php
namespace app\modules\demo\controllers;

use yii\web\Controller;

class DemoController extends Controller
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        echo "success";
    }
}
