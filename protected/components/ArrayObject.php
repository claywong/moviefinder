<?php
namespace app\components;

use yii\base\Object;

class ArrayObject extends Object
{
    /**
     * @var array
     */
    public $data = [];

    public function __construct($data = [], $config = [])
    {
        if (is_array($data)) {
            $this->data = $data;
        }
        parent::__construct($config);
    }
}
