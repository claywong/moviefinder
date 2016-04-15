<?php
namespace app\modules\demo\commands;

use app\components\ConsoleCommand;

class CommandController extends ConsoleCommand
{
    public $author = '';
    
    public function options($actionID)
    {
        return ['author'];
    }
    
    /**
     * ./yii demo/command/hello-world abc@camera360.com 18812345678 --author=abc
     * 
     * @param string $email
     * @param string $mobile
     * @param string $country
     * @return int
     */
    public function actionHelloWorld($email, $mobile, $country = 'china')
    {
        if (empty($email) || empty($mobile) || empty($country)) {
            return self::EXIT_CODE_ERROR;
        }
        echo "author:\t$this->author\n";
        echo "email:\t$email\n";
        echo "mobile:\t$mobile\n";
        echo "country:\t$country\n";
        
        return self::EXIT_CODE_NORMAL;
    }
}