<?php
namespace app\components;

use yii\helpers\ArrayHelper;

class Client extends \yii\httpclient\Client
{
    static $options = [
        CURLOPT_TIMEOUT_MS => 1000,
    ];
    
    /**
     * @var array response config configuration.
     */
    public $responseConfig = [
        'class' => 'app\components\Response',
    ];
    
    /**
     * @var Transport|array|string|callable HTTP message transport.
     */
    private $_transport = 'yii\httpclient\CurlTransport';

    /**
     * @inheritdoc
     */
    public function get($url, $data = null, $headers = [], $options = [])
    {
        $options = ArrayHelper::merge(self::$options, $options);
        return parent::get($url, $data, $headers, $options);
    }
    
    /**
     * @inheritdoc
     */
    public function post($url, $data = null, $headers = [], $options = [])
    {
        $options = ArrayHelper::merge(self::$options, $options);
        return parent::post($url, $data, $headers, $options);
    }
}
