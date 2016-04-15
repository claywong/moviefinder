<?php
namespace app\lib\helpers;

use Yii;
use pgc\helpers\SecurityHelper;
use pgc\helpers\HttpCallHelper;
use pgc\log\LogHelper;
use pgc\exceptions\Errno;
use pgc\exceptions\ParameterValidationExpandException;

class SsoUserHelper
{
    
    /**
     *批量获取系统系统用户信息
     * @param array $userids  用户id数组
     * @param string $locale  语言 默认中文
     * @return [02700e52244725974ce8df73 => [
        [userId] => 02700e52244725974ce8df73
        [email] => claywong@qq.com
        [avatar] => https://dn-c360.qbox.me/c11e509d955e48f3ac0255b65b890407
        [lastLoginTime] => 1394529023
        [nickname] => clay57
        [gender] => 1
        [birthday] => 1987-01-01
    ]
    
    [06b38752244685426d55b5cc] => [
        [userId] => 06b38752244685426d55b5cc
        [email] => claywong@sina.cn
        [avatar] => https://dn-c360.qbox.me/1f7cc08b61263bfce16c42bb51a85b04
        [lastLoginTime] => 1394089558
        [nickname] => ClayWong
        [gender] => 
        [birthday] => 
    ]
     */
    public static function multiInfo(array $userids, $locale = '')
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/multi';
        $postArr = array(
            'appkey' => $ssoUserConfig['appkey'],
            'userIds' => join(',', $userids),
        );
        $locale && $postArr['locale'] = $locale;
        $sign = SecurityHelper::sign($postArr, $ssoUserConfig['appsecret']);
        $postArr['sig'] = $sign;
        $url .= '?' . http_build_query($postArr);
        $data = HttpCallHelper::execHttpCall($url, array(), 'GET');
        $out = array();
        if ($data) {
            foreach ($data as $uid => $user) {
                if (isset($user['email'])) {
                    $user['email'] = '';
                }
                $out[$uid] = $user;
            }
        }
        
        return $out;
    }

    /**
     * 使用token交换用户信息
     * @param string $userId 
     * @param string $appkey 
     * @param string $token 
     * @access public
     * @return array/false
     */
    public static function exchangeInfo($userId, $appkey, $token)
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/info';
        $params = array(
            'appkey'    => $ssoUserConfig['appkey'],
            'userId'    => $userId,
            'token'     => $token,
        );
        $sign = SecurityHelper::sign($params, $ssoUserConfig['appsecret']);
        $params['sig'] = $sign;
        $url .= '?' . http_build_query($params);
        try {
            return HttpCallHelper::execHttpCall($url, array(), 'GET');
        } catch (\Exception $ex) {
            if ($ex->getCode() == Errno::FATAL) {
                LogHelper::error('获取用户信息异常. exception-' . $ex->getMessage());
            } else {
                LogHelper::warning('获取用户信息失败. status-' . $ex->getCode() . ' message-' . $ex->getMessage());
            }
        }
        return false;
    }
    
    /**
     * email登录
     * @param unknown $email
     * @param unknown $password
     * @param string $locale
     * @return mixed
     */
    public static function emailLogin($email, $password, $locale = '')
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            throw new ParameterValidationExpandException('Invalid Email', ParameterValidationExpandException::ERROR_REQUIREDRE_CODE);
        }
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/login';
        $postArr = array(
            'appkey' => $ssoUserConfig['appkey'],
            'email' => $email,
            'password' => $password,
        );
        $locale && $postArr['locale'] = $locale;
        $sign = SecurityHelper::sign($postArr, $ssoUserConfig['appsecret']);
        $postArr['sig'] = $sign;
        return HttpCallHelper::execHttpCall($url, $postArr, 'POST');
    }
    
    /**
     * email登录
     * @param unknown $email
     * @param unknown $password
     * @param string $locale
     * @return mixed
     */
    public static function emailRegister($email, $password, $locale = '')
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            throw new ParameterValidationExpandException('Invalid Email', ParameterValidationExpandException::ERROR_REQUIREDRE_CODE);
        }
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/register';
        $postArr = array(
            'appkey' => $ssoUserConfig['appkey'],
            'email' => $email,
            'password'=>$password,
        );
        $locale && $postArr['locale'] = $locale;
        $sign = SecurityHelper::sign($postArr, $ssoUserConfig['appsecret']);
        $postArr['sig'] = $sign;
        return HttpCallHelper::execHttpCall($url, $postArr, 'POST');
    }
    
    
    /**
     * 使用token交换用户信息
     * @param string $userId
     * @param string $appkey
     * @param string $token
     * @access public
     * @return array/false
     */
    public static function nickname($nickname)
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/nickname';
        $params = array(
            'appkey' => $ssoUserConfig['appkey'],
            'nickname' => $nickname,
        );
        $sign = SecurityHelper::sign($params, $ssoUserConfig['appsecret']);
        $params['sig'] = $sign;
        $url .= '?' . http_build_query($params);
        return HttpCallHelper::execHttpCall($url, array(), 'GET');
    }
    
    /**
     * 通过email获取用户信息
     * @param unknown $email
     * @return mixed
     */
    public static function emailUser($email) 
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/email';
        $params = array(
            'appkey' => $ssoUserConfig['appkey'],
            'email' => $email,
        );
        $sign = SecurityHelper::sign($params, $ssoUserConfig['appsecret']);
        $params['sig'] = $sign;
        return HttpCallHelper::execHttpCall($url, $params, 'POST');
    }
    
    /**
     * 手机号查询用户信息
     * @param string $mobile
     */
    public static function mobileUser($mobile)
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/mobile';
        $params = array(
            'appkey' => $ssoUserConfig['appkey'],
            'mobile' => $mobile,
        );
        $sign = SecurityHelper::sign($params, $ssoUserConfig['appsecret']);
        $params['sig'] = $sign;
        return HttpCallHelper::execHttpCall($url, $params, 'POST');
    }
    
    /**
     * 修改用户信息
     * @param unknown_type $userId
     * @param unknown_type $token
     * @param unknown_type $doc
     */
    public static function updateInfo($userId, $token, $doc)
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/api/user/updateInfo';
        $params = array(
            'appkey' => $ssoUserConfig['appkey'],
            'userId' => $userId,
            'token' => $token,
        );
        $params = array_merge($params, $doc);
        $sign = SecurityHelper::sign($params, $ssoUserConfig['appsecret']);
        $params['sig'] = $sign;
        return HttpCallHelper::execHttpCall($url, $params, 'POST');
    }

    /**
     * 通过内部接口获取用户token
     * @param string $userId 
     * @access public
     * @return array
     */
    public static function userToken($userId) 
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . '/inner/user/token';
        $postArr = array(
            'userId' => $userId,
        );
        return HttpCallHelper::execHttpCall($url, $postArr, 'POST');
    }
    
    public static function checknick($nick)
    {
        $ssoUserConfig = Yii::app()->params['ssoUser'];
        $url = $ssoUserConfig['host'] . ' /api/user/checknick';
        $postArr = array(
            'nickname' => $nick,
        );
        return HttpCallHelper::execHttpCall($url, $postArr, 'POST');
    }
}
