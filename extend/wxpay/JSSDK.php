<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2018-2020 The MingYu                                   |
// +----------------------------------------------------------------------+
// | Authors: Original Author <285412937@qq.com>                          |
// |          MingYu <285412937@qq.com>                                   |
// +----------------------------------------------------------------------+
namespace wxpay;

use Think\Controller;
class JSSDK
{
    private $appId;
    private $appSecret;
    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }
    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=" . $jsapiTicket . "&noncestr=" . $nonceStr . "&timestamp=" . $timestamp . "&url=" . $url;
        $signature = sha1($string);
        $signPackage = array("appId" => $this->appId, "nonceStr" => $nonceStr, "timestamp" => $timestamp, "url" => $url, "signature" => $signature, "rawString" => $string);
        return $signPackage;
    }
    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    public function getJsApiTicket()
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("./js_token.php"));
        // dump($this->get_php_file("./js_token.php"));
        if ($data->expire_time < time()) {
            $accessToken = $this->getAccessToken();
            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $accessToken . "&type=jsapi";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            // var_dump($url);
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $this->set_php_file("./js_token.php", json_encode($data));
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }
    public function getAccessToken()
    {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("./access_token.php"));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appId . "&secret=" . $this->appSecret;
            $res = $this->getJson($url);
            $access_token = $res['access_token'];
            // var_dump($res);
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $this->set_php_file("./access_token.php", json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
        // $aa = $access_token;
        // var_dump($aa);
    }
    //获取access_token
    public function getJson($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        // var_dump(json_decode($output, true));
        return json_decode($output, true);
    }
    //获取ticket
    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $res = curl_exec($curl);
        // var_dump($res);
        curl_close($curl);
        return $res;
    }
    private function get_php_file($filename)
    {
        //return file_get_contents($filename);
        return trim(substr(file_get_contents($filename), 15));
        // echo trim(substr(file_get_contents($filename), 15));die;
        // $aa = trim(substr(file_get_contents($filename), 15));
    }
    private function set_php_file($filename, $content)
    {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
    /* js微信分享 
     *  主目录下新建两个php文件 
     * access_token.php  内容 
     * <?php exit();?>{"expire_time":1536831273,"access_token":"13_qGr3u9-6vJcWtWbNh062XAuoCzyDMP2EHuejOWPG8hyu4cMdSnAoKVeABEShfb_ZSEjzqncM6hHdyWGaPM5GNL-Bukge2lsg3Fjbbyhs18v3Bt4ZQycHWgDHu87aoiWDaZvXY6y9Y9eBHI7WXPOfAAAFXW"} 
     * js_token.php 内容  
     * <?php exit();?>{"expire_time":1536831273,"access_token":"13_hfsKrIGH1zNmnU3oGE7lokRKQn8qmSKosR2EJ6Y18iQ0TP1jzBFGQENPffgpBZinZtSUYOx3zYqt1FmLflaV_u5koLzWG6iUmcX8q4UTJ38Z5YXCl6ER7i1hQoqAhYPb2BscrklLqR4491ogVPNaAJAGAY","jsapi_ticket":"kgt8ON7yVITDhtdwci0qebAOcaMc7J_WawYQWZ5gMOVVgYqrlc_zWWG2-uIMwHcktaf5BJg0-NmcNBNxCuG_nA"}
     * $jssdk = new JSSDK($this->appid, $this->appselect);
     * $signPackage = $jssdk->GetSignPackage();	 
     * $this->assign('appid',$signPackage["appId"]);
     * $this->assign('timestamp',$signPackage["timestamp"]);
     * $this->assign('nonceStr',$signPackage["nonceStr"]);
     * $this->assign('signature',$signPackage["signature"]);	    
     * $share=['title'=>'465465','desc'=>'分享领红包','link'=>'','imgurl'=>''];
     * $this->assign('share',$share);  * 
     */
}