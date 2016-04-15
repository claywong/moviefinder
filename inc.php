<?php
/**
 * 下载URL指定内容，支持HTTP、HTTPS、FTP等协议，支持返回内容或者写入指定文件。
 * @param string $url 下载地址
 * @param int $timeout 超时时间
 * @return bool|string TRUE，FALSE或者内容
 */
function get($url, $timeout = 5)
{
    $arrUrl = parse_url($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return = curl_exec($ch);
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $return;
}