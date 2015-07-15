<?php

include "wechat.class.php";
$options = array(
    'token'=>'vonvon', //填写你设定的key
    'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
    'appid'=>'wx519f23f4a45e8c37',//填写高级调用功能的appid
    'appsecret'=>'ea8f0b17b3a0882bf5fda7ed27758482' //填写高级调用功能的密钥
);
$weObj = new Wechat($options);

$data = $weObj->getOauthAccessToken();

$info = $weObj->getOauthUserinfo($data['access_token'],$data['openid']);

switch($info['sex']) {
    case '1':
        $info['sex'] = '男';
        break;
    case '2':
        $info['sex'] = '女';
        break;
    default:
        $info['sex'] = '未知';
}
$info['nickname'] = iconv('gb2312','utf8',$info['nickname']);

echo "Your nickname is ".$info['nickname']."<br />Your sex is ".$info['sex']."<br />Your city is ".$info['city']."<br />Your province is ".$info['province']."<br />Your country is ".$info['country']."<br />Now is ".date("Y-m-d H:i:s",time())."<br />";

echo "<img src='".$info['headimgurl']."'>";