<?php
namespace app\modules\crawl;

use Yii;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module
{
    public function __construct($id, $parent = null, $config = [])
    {
        $moduleName = basename(__DIR__);
        !defined('MODULE_NAME') && define('MODULE_NAME', $moduleName);
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\\modules\\' . $moduleName . '\\commands';
            $configPath = __DIR__ . '/config/' . strtolower(APPLICATION_ENV) .'/console.php';
        } else {
            $configPath = __DIR__ . '/config/' . strtolower(APPLICATION_ENV) .'/main.php';
        }
        if (!is_readable($configPath)) {
            throw new \yii\web\HttpException(405, "$configPath is not readalbe");
        }
        /**
         * 从Yii1升级到Yii2后，模块配置被独立出来，不再与应用配置合并，因此读取配置的方法也要改变，
         * 例如：Yii::$app->getModule(MODULE_NAME)->params['xxx']
         */
        parent::__construct($id, $parent, ArrayHelper::merge($config, require($configPath)));
    }
}
