<?php
namespace app\components;

use yii\base\Exception;
use pgc\exceptions\Errno;

class Response extends \yii\httpclient\Response
{
    public function getStatus()
    {
        $data = parent::getData();
        $this->getIsOk();
        return $data['status'];
    }
    
    public function getMessage()
    {
        $data = parent::getData();
        $this->getIsOk();
        return $data['message'];
    }
    
    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->getIsOk();
        $data = parent::getData();
        return $data['data'];
    }
    
    public function getIsOk()
    {
        if (!parent::getIsOk()) {
            throw new Exception('http code is ' . $this->getStatusCode(), Errno::INTERNAL_SERVER_ERROR);
        }
        $data = parent::getData();
        if (!array_key_exists('status', $data)) {
            throw new Exception('unexpected json structure, missing "status":' . $this->getContent(), Errno::INTERNAL_SERVER_ERROR);
        }
        if (!array_key_exists('message', $data)) {
            throw new Exception('unexpected json structure, missing "message":' . $this->getContent(), Errno::INTERNAL_SERVER_ERROR);
        }
        if (!array_key_exists('data', $data)) {
            throw new Exception('unexpected json structure, missing "data":' . $this->getContent(), Errno::INTERNAL_SERVER_ERROR);
        }
        if (intval($data['status']) !== 200) {
            throw new Exception($data['message'] . ' with status ' . $data['status'], intval($data['status']));
        }
        return true;
    }
}