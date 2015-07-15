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

echo "Your nickname is ".$info['nickname']."\nYour sex is ".$info['sex']."\nYour city is ".$info['city']."\nYour province is ".$info['province']."\n Your country is ".$info['country']."\nYour subscribe_time is ".date("Y-m-d H:i:s",$info['subscribe_time'])."\nNow is ".date("Y-m-d H:i:s",time());

echo "<img src='".$info['headimgurl']."'>";