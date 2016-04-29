<?php
namespace app\modules\crawl\commands;

use app\components\ConsoleCommand;

class CommandController extends ConsoleCommand
{
    public $author = '';
    
    public function options($actionID)
    {
        return ['author'];
    }
    
    /**
     * ./yii crawl/command/hello-world abc@163.com 111 --author=abc
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