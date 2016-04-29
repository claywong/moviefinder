<?php
namespace app\modules\crawl\controllers;
use Yii;
use yii\web\Controller;

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
            'uid' => $uid
        ];
        echo 'success';
    }
}
