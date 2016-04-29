<?php
namespace app\modules\crawl\commands;

use app\components\ConsoleCommand;

class LatestMovieController extends ConsoleCommand
{
    
    /**
     * ./yii crawl/latest-movie/get 
     * 
     * 获取最新的电影列表
     * 
     * @return int
     */
    public function actionGet()
    {
        echo 'success';
        return self::EXIT_CODE_NORMAL;
    }
}