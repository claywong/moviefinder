<?php
require_once 'inc.php';
require_once 'simple_html_dom.php';


//获取流行的电影

function getDoubanNowPlayingContent(){
    $doubanNowPlayingUrl = "http://movie.douban.com/nowplaying/chengdu/";
    $doubanNowPlayingRawContent = get($doubanNowPlayingUrl);
    file_put_contents("doubanNowPlayingRawContent", $doubanNowPlayingRawContent);
    return true;
}

$doubanNowPlayingRawContent = file_get_contents("doubanNowPlayingRawContent");

$html = new simple_html_dom();
$html->load($doubanNowPlayingRawContent);
// 查找id为main的div元素
$main = $html->find("#nowplaying",0);
$itemList = $main->find("ul li");
$movieList = array();
foreach ($itemList as $item) {
    $attr = $item->attr;
    if (empty($attr['id'])) {
        continue;
    }
    $movie = array('channel' => 'douban');
    $movie['thirdId'] = $attr['id'];
    $movie['title'] = $attr['data-title'];
    $movie['score'] = $attr['data-score'];
    $movie['release'] = $attr['data-release'];
    $movie['duration'] = $attr['data-duration'];
    $movie['director'] = $attr['data-director'];
    $movie['actors'] = $attr['data-actors'];
    $elementList = $item->find("ul li a img ");
    $movie['poster'] = $elementList[0]->src;
    $movieList[] = $movie;
}
