<?php
namespace app\modules\demo\inner\controllers;

use app\components\InnerController;
use pgc\helpers\ParameterValidatorHelper;
use pgc\helpers\ResponseHelper;

class DemoController extends InnerController
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $uid = ParameterValidatorHelper::validateString($_REQUEST, 'uid');
        $data = [
            'uid' => $uid,
        ];
        ResponseHelper::outputJsonV2($data);
    }
}
