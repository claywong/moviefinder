<?php
namespace app\components;

use pgc\log\LogHelper;
use pgc\helpers\ResponseHelper;
use pgc\exceptions\ParameterValidationExpandException;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends \pgc\web\Controller
{

    public function init()
    {
        parent::init();

        // 增加Ajax标识，用于异常处理
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        }
        !defined('MODULE_NAME') && define('MODULE_NAME', SYSTEM_NAME);

        // 打印请求参数
        $arrLogParams = $_REQUEST;
        if (isset($arrLogParams['token'])) {
            $arrLogParams['token'] = '***<' . strlen($arrLogParams['token']) . 'chars>';
        }
        if (isset($arrLogParams['userToken'])) {
            $arrLogParams['userToken'] = '***<' . strlen($arrLogParams['userToken']) . 'chars>';
        }
        LogHelper::pushLog('params', $arrLogParams);
    }
    
    public function behaviors()
    {
        return [
            'checkCommonParameters' => [
                'class' => \pgc\filters\CheckCommonParameters::className(), // 检验公共参数.
            ],
            'verifySign' => [
                'class' => \pgc\filters\VerifySign::className(),
                'appsecret' => '*jNb29>,1*)4`:\\Bo)023&3MnvQ14Lk@',
                'godSig' => '56610f9fce1cdd07098cd80d',
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => $this->accessRules(),
                'denyCallback' => 'accessDenied',
            ],
        ];
    }

    public function runAction($id, $params = [])
    {
        try {
            parent::runAction($id, $params);
        } catch (ParameterValidationExpandException $e) {
            LogHelper::error($e->getMessage() . ' with code ' . $e->getCode());
            ResponseHelper::outputJsonV2([], $e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            LogHelper::error($e->getMessage() . ' with code ' . $e->getCode());
            ResponseHelper::outputJsonV2([], $e->getMessage(), $e->getCode());
        }
    }
}
