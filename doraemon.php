<?php
header("Content-Type: text/html; charset=UTF-8");
include "wechat.class.php";
$options = array(
    'token'=>'vonvon', //填写你设定的key
    'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
    'appid'=>'wx519f23f4a45e8c37',//填写高级调用功能的appid
    'appsecret'=>'ea8f0b17b3a0882bf5fda7ed27758482' //填写高级调用功能的密钥
);
$weObj = new Wechat($options);

$data = $weObj->getOauthAccessToken();
//$new = $weObj->getOauthRefreshToken($data['refresh_token']);

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

require_once "js/jssdk.php";
$jssdk = new JSSDK("wx519f23f4a45e8c37", "ea8f0b17b3a0882bf5fda7ed27758482");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html><html lang="zh-CN" class="ua-wk ua-win ua-win-nt6 ua-win-nt63">
<!-- date: 2015-07-17 -->
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0" />
<title>哆啦A梦：最后的礼物</title>
<link rel="shortcut icon" type="image/x-icon" href="http://lxfm-s.malmam.com/images/lvxingfm_favicon.ico" />
<link rel="icon" type="image/x-icon" href="http://lxfm-s.malmam.com/images/lvxingfm_favicon.ico" />
<link href="http://lxfm-s.malmam.com/file-cache/css/c/styles-to-cssfile/2787a203a59cfd94354ce36c1457ecc2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://libs.malmam.com/jquery/jquery-1.11.0.min.js">
</script>
</head>
<body>
<div class="webform"><!-- step 1 -->
<img class="logo" width="74%" src="http://lxfm-s.malmam.com/uploads/image/150529/2798644_1152733_83cf8e6c52_o.png" alt="" />
<div class="pocket"><img width="100%" src="http://lxfm-s.malmam.com/uploads/image/150529/2798645_1152733_f335e1c9f5_o.png" alt="" /> <img id="frame" class="frame" width="100%" src="http://lxfm-s.malmam.com/uploads/image/150529/2798646_1152733_d8186291f1_o.png" alt="" name="frame" />
<div class="inner-pocket" id="inner-pocket"><img width="100%" src="http://lxfm-s.malmam.com/uploads/image/150601/2798843_1152733_bda75ffd0e_o.png" alt="" /></div>
</div>
<div class="prop"><a href="javascript:void(0)" id="get-prop" name="get-prop"><img height="90%" src="<?php echo $info['headimgurl'];?>" alt="点击你的头像" /></a></div>
<!-- step 2 -->
<div class="result hide" id="result">
<div class="g">
<div class="title">我马上要回22世纪了<br />
这最后的礼物，喜欢吗？</div>
<div class="prop-box">
<audio name="media" start="0" id="back-sound" preload="auto"></audio>
<audio name="media" start="0" preload="auto">
<source src="http://lxfm-file.malmam.com/dfs/3/f71bfcd50447/_A_.mp3" type="audio/mpeg" id="back-sound-source"></source>
</audio>
<img class="prop" src="" width="100%" alt="" /> <img class="hander" src="http://lxfm-s.malmam.com/uploads/image/150530/2798676_1152733_949228a030_o.png" width="40%" alt="" /></div>
<div class="name"></div>
<div class="tooler"><span class="save-prop" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Fdoraemon.php&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect"><img width="30%" src="http://lxfm-s.malmam.com/uploads/image/150530/2798677_1152733_41020ac669_o.png" alt="收下礼物" /></span> <img id="again" width="30%" src="http://lxfm-s.malmam.com/uploads/image/150530/2798678_1152733_d52a7e671b_o.png" alt="再抽一次" name="again" /></div>
</div>
</div>
<!-- show -->
<div class="show hide" id="show"><img src="http://lxfm-s.malmam.com/uploads/image/150601/2798842_1152733_591eec31e4_o.png" width="60%" alt="" /></div>
<div class="show hide" id="give-other"><img src="http://lxfm-s.malmam.com/uploads/image/150601/2798841_1152733_e344af7727_o.png" width="60%" alt="" /></div>
</div>
<script type="text/javascript">
//<![CDATA[

 var ALL_PROPS = [{"name":"ns\u5fbd\u7ae0","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150530\/2798675_1152733_69127c9af6_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzAlMkYyNzk4Njc1XzExNTI3MzNfNjkxMjdjOWFmNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7231\u610f\u9633\u4f1e","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798688_1152733_b5db9aa6d7_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njg4XzExNTI3MzNfYjVkYjlhYTZkN19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7eca\u5012\u673a\u5668\u4eba","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798689_1152733_4b12e2ef4b_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njg5XzExNTI3MzNfNGIxMmUyZWY0Yl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u53d8\u5927\u53d8\u5c0f\u96a7\u9053","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798690_1152733_4f1f03e97a_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NjkwXzExNTI3MzNfNGYxZjAzZTk3YV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8d85\u7ea7\u624b\u5957","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798691_1152733_1aef35dd0a_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NjkxXzExNTI3MzNfMWFlZjM1ZGQwYV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7a7f\u900f\u5708","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798692_1152733_8a8fe24e52_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NjkyXzExNTI3MzNfOGE4ZmUyNGU1Ml9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u52a8\u7269\u53d8\u8eab\u997c\u5e72","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798693_1152733_c4c59e52ac_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NjkzXzExNTI3MzNfYzRjNTllNTJhY19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u72ec\u88c1\u8005\u6309\u94ae","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798694_1152733_c8794647da_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njk0XzExNTI3MzNfYzg3OTQ2NDdkYV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6076\u9b54\u62a4\u7167","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798695_1152733_0e9244c120_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njk1XzExNTI3MzNfMGU5MjQ0YzEyMF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7ffb\u8bd1\u679c\u51bb","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798696_1152733_545f9ea7a9_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njk2XzExNTI3MzNfNTQ1ZjllYTdhOV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u653e\u5927\u706f","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798697_1152733_0cd74a07eb_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njk3XzExNTI3MzNfMGNkNzRhMDdlYl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8d76\u4eba\u72d7","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798703_1152733_cbd129258f_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzAzXzExNTI3MzNfY2JkMTI5MjU4Zl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u56fd\u5883\u9632\u5fa1\u90e8\u961f","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798709_1152733_3d6c8fc7d0_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzA5XzExNTI3MzNfM2Q2YzhmYzdkMF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u822a\u65f6\u706f","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798715_1152733_593f668456_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzE1XzExNTI3MzNfNTkzZjY2ODQ1Nl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u597d\u670b\u53cb\u673a\u5668\u4eba","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798720_1152733_9c24e8e382_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzIwXzExNTI3MzNfOWMyNGU4ZTM4Ml9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6362\u8863\u76f8\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798726_1152733_cf6e7acc33_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzI2XzExNTI3MzNfY2Y2ZTdhY2MzM19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8ba1\u7b97\u673a\u94c5\u7b14","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798732_1152733_df0a376ff1_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzMyXzExNTI3MzNfZGYwYTM3NmZmMV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8bb0\u5fc6\u9762\u5305","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798736_1152733_2c80a63e46_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzM2XzExNTI3MzNfMmM4MGE2M2U0Nl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8fdb\u5316\u9000\u5316\u5149\u7ebf","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798746_1152733_12ba12808c_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzQ2XzExNTI3MzNfMTJiYTEyODA4Y19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7a7a\u6c14\u70ae","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798747_1152733_63846715a6_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzQ3XzExNTI3MzNfNjM4NDY3MTVhNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u72fc\u4eba\u9762\u971c","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798748_1152733_229417e348_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzQ4XzExNTI3MzNfMjI5NDE3ZTM0OF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7acb\u4f53\u5f71\u50cf\u5668","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798749_1152733_3f4c97b52c_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzQ5XzExNTI3MzNfM2Y0Yzk3YjUyY19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u68a6\u98ce\u94c3","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798750_1152733_50b7766f0e_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzUwXzExNTI3MzNfNTBiNzc2NmYwZV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8ff7\u4f60\u591a\u5566","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798751_1152733_927c2fd08c_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzUxXzExNTI3MzNfOTI3YzJmZDA4Y19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8ff7\u4f60\u63a8\u571f\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798752_1152733_6d3a3409dd_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzUyXzExNTI3MzNfNmQzYTM0MDlkZF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u519c\u573a\u9053\u5177\u7ec4\u5408","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798753_1152733_556b310e26_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzUzXzExNTI3MzNfNTU2YjMxMGUyNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u5947\u5e7b\u773c\u955c","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798754_1152733_f4b380d0fa_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzU0XzExNTI3MzNfZjRiMzgwZDBmYV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6a35\u592b\u4e4b\u6cc9","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798755_1152733_66a0ee2e16_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzU1XzExNTI3MzNfNjZhMGVlMmUxNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u60c5\u4fa3\u6d4b\u8bd5\u5fbd\u7ae0","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798756_1152733_1c65328490_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzU2XzExNTI3MzNfMWM2NTMyODQ5MF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u4e18\u6bd4\u7279\u4e4b\u7bad","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798757_1152733_b4d1dc20e6_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzU3XzExNTI3MzNfYjRkMWRjMjBlNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u53d6\u7269\u671b\u8fdc\u955c","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798758_1152733_d3fb98de02_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzU4XzExNTI3MzNfZDNmYjk4ZGUwMl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u4efb\u610f\u95e8","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798759_1152733_ab84d3a648_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzU5XzExNTI3MzNfYWI4NGQzYTY0OF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u5982\u610f\u7535\u8bdd\u4ead","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798764_1152733_95dc3a9f5b_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzY0XzExNTI3MzNfOTVkYzNhOWY1Yl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u795e\u4ed9\u673a\u5668\u4eba","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798767_1152733_e188f381e3_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzY3XzExNTI3MzNfZTE4OGYzODFlM19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u58f0\u97f3\u51dd\u56fa\u5242","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798771_1152733_25d0e82d47_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzcxXzExNTI3MzNfMjVkMGU4MmQ0N19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u77f3\u5934\u5e3d","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798776_1152733_4f0197792b_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzc2XzExNTI3MzNfNGYwMTk3NzkyYl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u65f6\u5149\u5305\u88b1\u5dfe","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798782_1152733_b7e17e6b3f_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzgyXzExNTI3MzNfYjdlMTdlNmIzZl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u65f6\u5149\u7535\u89c6\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798789_1152733_841bd642b2_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzg5XzExNTI3MzNfODQxYmQ2NDJiMl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u65f6\u5149\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798793_1152733_0dd04fe9cc_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4NzkzXzExNTI3MzNfMGRkMDRmZTljY19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u65f6\u5149\u76ae\u5e26","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798795_1152733_22ef1981c2_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzk1XzExNTI3MzNfMjJlZjE5ODFjMl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u5ba4\u5185\u9493\u9c7c\u6c60","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798796_1152733_b55eb316dc_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzk2XzExNTI3MzNfYjU1ZWIzMTZkY19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u77ac\u95f4\u79fb\u52a8\u6f5c\u6c34\u8247","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798797_1152733_3ef96d3f4a_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzk3XzExNTI3MzNfM2VmOTZkM2Y0YV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u56db\u5b63\u5fbd\u7ae0","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798798_1152733_3660c15d58_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzk4XzExNTI3MzNfMzY2MGMxNWQ1OF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u96a7\u9053\u6316\u6398\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798799_1152733_5258056509_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Nzk5XzExNTI3MzNfNTI1ODA1NjUwOV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7f29\u5c0f\u706f","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798800_1152733_eb6b3a8f19_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODAwXzExNTI3MzNfZWI2YjNhOGYxOV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6843\u592a\u90ce\u996d\u56e2","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798801_1152733_9b5d8783c2_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODAxXzExNTI3MzNfOWI1ZDg3ODNjMl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8ba8\u538c\u7ae0\u9c7c","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798802_1152733_31bbd61736_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODAyXzExNTI3MzNfMzFiYmQ2MTczNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8717\u725b\u5c4b","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798686_1152733_e425192ea8_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4Njg2XzExNTI3MzNfZTQyNTE5MmVhOF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6e32\u67d3\u6c14\u6c1b\u7684\u4e50\u56e2","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798803_1152733_e4a782523c_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODAzXzExNTI3MzNfZTRhNzgyNTIzY19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u5ef6\u957f\u65f6\u5149\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798804_1152733_9aacbb0b5c_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODA0XzExNTI3MzNfOWFhY2JiMGI1Y19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6e38\u6cf3\u7c89","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798805_1152733_8e936fd908_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODA1XzExNTI3MzNfOGU5MzZmZDkwOF9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u62db\u4eba\u732b","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798806_1152733_00e6820237_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODA2XzExNTI3MzNfMDBlNjgyMDIzN19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6b63\u76f4\u592a\u90ce","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798807_1152733_3a3a38c6f6_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODA3XzExNTI3MzNfM2EzYTM4YzZmNl9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u6307\u8def\u5929\u4f7f","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798808_1152733_e78f65c8aa_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODA4XzExNTI3MzNfZTc4ZjY1YzhhYV9vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u7af9\u873b\u8713","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798809_1152733_e8dc2ba0a3_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODA5XzExNTI3MzNfZThkYzJiYTBhM19vLnBuZyZ3PTEyMA--\/img.jpg"},{"name":"\u8bc5\u5492\u7167\u76f8\u673a","pic":"http:\/\/lxfm-s.malmam.com\/uploads\/image\/150531\/2798810_1152733_0d5ee3f765_o.png","icon":"http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA1MzElMkYyNzk4ODEwXzExNTI3MzNfMGQ1ZWUzZjc2NV9vLnBuZyZ3PTEyMA--\/img.jpg"}];
 var PROP_ID = 0;
 var getFromFriend = false;
  var host = "http://www.nahaowan.com";

 (function($) {
   var frameImageUrl = [
     "http://lxfm-s.malmam.com/uploads/image/150529/2798646_1152733_d8186291f1_o.png",
     "http://lxfm-s.malmam.com/uploads/image/150529/2798650_1152733_927af7ea3d_o.png",
     "http://lxfm-s.malmam.com/uploads/image/150529/2798651_1152733_f201f66333_o.png",
     "http://lxfm-s.malmam.com/uploads/image/150529/2798652_1152733_29fe23e812_o.png",
     "http://lxfm-s.malmam.com/uploads/image/150529/2798651_1152733_f201f66333_o.png",
     "http://lxfm-s.malmam.com/uploads/image/150529/2798653_1152733_ccd09e63e1_o.png"
   ];
   var frameObject = [];
   var imageCount = frameImageUrl.length;
   var unloadedCount = imageCount;
   for(var i = 0; i < imageCount; i++) {
     var oImg = new Image();
     oImg.src = frameImageUrl[i];
     oImg.onload = function() {
       unloadedCount--;
     };
     frameObject[i] = oImg;
   }
   //背景
   var backImageUrl = [
     'http://lxfm-s.malmam.com/uploads/image/150530/2798674_1152733_4fc9712c9d_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798811_1152733_c93e3d0b84_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798812_1152733_1e882b191e_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798813_1152733_80c1555472_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798814_1152733_1c8f96a9a2_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798815_1152733_dc149db997_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798816_1152733_bfca231a8b_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798817_1152733_3a8a99ef1f_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798818_1152733_4f30592bfe_o.jpg',
     'http://lxfm-s.malmam.com/uploads/image/150531/2798819_1152733_fd099783c7_o.jpg'
   ];
   var backImageCount = backImageUrl.length;
   var backImages = [];
   for(var i = 0; i < backImageCount; i++) {
     backImages[i] = null;
   }
   var getingProp = null;
   var frame = $("#frame");
   var result = $("#result");
   var show = $("#show");
   var give = $("#give-other");
   var loadedBack = false;
   var backImageKey = 0;
   var player = document.getElementById("back-sound");
   var source = document.getElementById("back-sound-source");

   var preload = false;

   if(getFromFriend === true) {
     player.src = source.src;
     player.play();
   }
   function getProp() {
     if(getingProp) {
       return;
     }

     result.hide();
     show.hide();

     PROP_ID = parseInt(Math.random()*ALL_PROPS.length);
     PROP_ID = Math.min(PROP_ID, ALL_PROPS.length - 1);

     preload = false;
     $.ajax({
       url:"\/huodong\/doraemon\/ajax-create-key",
       type:"POST",
       data:{prop_id:PROP_ID}
     }).done(function(data){
       var key = data.data.key;
       wxShareDataArray[0][2] =  ALL_PROPS[PROP_ID].icon;
       wxShareDataArray[0][3] = data.data.url;
       wxShareDataArray[1][2] =  ALL_PROPS[PROP_ID].icon;
       wxShareDataArray[1][3] = data.data.url;
       changeWeixinShareData(0, ALL_PROPS[PROP_ID].name);
       preload = true;
     }).complete(function(){

     });


     backImageKey = parseInt((Math.random() * 10));
     loadedBack = Boolean(backImages[backImageKey]);
     if(loadedBack === false) {
       var backImage = new Image();
       backImage.src = backImageUrl[backImageKey];
       backImage.onload = function() {
         loadedBack = true;
       };
       backImages[backImageKey] = backImage;
     }
     if(unloadedCount <=0) {
       player.src = "";
       player.play();
       frame.attr("src", frameObject[1].src);
       var step = 0;
       var rem = 2;
       getingProp = setInterval(function() {
         frame.attr("src", frameObject[rem].src);
         rem++;
         if(rem > 5) {
           rem = 2;
         }
         step++;
         if(step >= 10 && loadedBack === true) {
           //console.log(backImageKey);
           clearInterval(getingProp);
           getingProp = null;
           //frame.attr("src", frameObject[0].src);
           result.css("background-image", "url("+backImages[backImageKey].src+")");

           $('#result .prop').prop('src', ALL_PROPS[PROP_ID].pic);
           $('#result .name').text(ALL_PROPS[PROP_ID].name);
           player.src = source.src;
           player.play();
           result.show();

           //show.show();

         }
       }, 500);
       return;
     }
     alert("正在加载图片，请稍候...");
   }


   function saveProp(){

     $.ajax({
       url:"\/huodong\/doraemon\/ajax-save-prop",
       //dateType:"jsonp",
       type:"POST",
       data:{prop_id:PROP_ID}
     }).done(function(data){

       var key = data.data.key;
       wxShareDataArray[0][2] =  ALL_PROPS[PROP_ID].icon;
       wxShareDataArray[0][3] = data.data.url;

       wxShareDataArray[1][2] =  ALL_PROPS[PROP_ID].icon;
       wxShareDataArray[1][3] = data.data.url;
       changeWeixinShareData(0, data.data.name);

       show.show();



     }).complete(function(){

       //alert("complete");

       //switchStatus('saved');

     });

   }

   $("#inner-pocket").bind("click", getProp);

   $("#get-prop").bind("click", getProp);
   $("#again").bind("click", function() {
     if(getFromFriend === true) {
       frame.attr("src", frameObject[0].src);
       show.hide();
       give.hide();
       result.hide();
       getFromFriend = false;
       $(this).attr("src", "http://lxfm-s.malmam.com/uploads/image/150530/2798678_1152733_d52a7e671b_o.png").attr("alt", "再抽一次");
       return;
     }

     frame.attr("src", frameObject[0].src);
     show.hide();
     give.show();

     /*return;
     $.ajax({
       url:"\/huodong\/doraemon\/ajax-create-key",
       type:"POST",
       data:{prop_id:PROP_ID}
     }).done(function(data){
       var key = data.data.key;
       wxShareDataArray[0][2] =  ALL_PROPS[PROP_ID].icon;
       wxShareDataArray[0][3] = data.data.url;
       wxShareDataArray[1][2] =  ALL_PROPS[PROP_ID].icon;
       wxShareDataArray[1][3] = data.data.url;
       changeWeixinShareData(0, ALL_PROPS[PROP_ID].name);
       frame.attr("src", frameObject[0].src);
       show.hide();
       give.show();
     }).complete(function(){

     });*/
   });
   show.bind("click", function() {
     location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Fdoraemon.php&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect";
   });
   give.bind("click", function() {
     give.hide();
     show.hide();
     result.hide();
   });

   $('.save-prop').bind('click', function() {
     give.hide();
     show.show();
     saveProp();
   });


 })(jQuery);
//]]>
</script><!-- ga -->
<script type="text/javascript">
//<![CDATA[
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                              })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-41499901-2', '.nahaowan.com');
     ga('send', 'pageview');
//]]>
</script><!-- body append -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js?" type="text/javascript">
</script><script type="text/javascript">
//<![CDATA[
 var wxShareDataArray = [["\u54c6\u5566A\u68a6\u6700\u540e\u7684\u793c\u7269\uff01","\u4e34\u8d70\u524d\u9001\u4e86\u6211\u4e00\u4e2a[XX]\uff0c\u8c22\u8c22\u4f60\uff0c\u54c6\u5566A\u68a6","http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA2MDElMkYyNzk4ODM5XzVfNTcxNjA2YWI5YV9vLnBuZyZ3PTEyMA--\/img.jpg","http:\/\/www.nahaowan.com\/huodong\/doraemon\/"],["\u54c6\u5566A\u68a6\u6700\u540e\u7684\u793c\u7269\uff01","\u54c6\u5566A\u68a6\u7684[XX]\uff0c\u9001\u4f60\u4e86\uff01\u597d\u597d\u7528\u554a\uff01","http:\/\/lxfm-file.malmam.com\/sie\/aD0xMjAmbT1RJnVybD1odHRwJTNBJTJGJTJGbHhmbS1zLm1hbG1hbS5jb20lMkZ1cGxvYWRzJTJGaW1hZ2UlMkYxNTA2MDElMkYyNzk4ODM5XzVfNTcxNjA2YWI5YV9vLnBuZyZ3PTEyMA--\/img.jpg","http:\/\/www.nahaowan.com\/huodong\/doraemon\/"]];

 $(function(){
   wx.config({
       debug: false,
       appId: '<?php echo $signPackage["appId"];?>',
       timestamp: <?php echo $signPackage["timestamp"];?>,
       nonceStr: '<?php echo $signPackage["nonceStr"];?>',
       signature: '<?php echo $signPackage["signature"];?>',
     jsApiList: ["onMenuShareTimeline","onMenuShareAppMessage","startRecord","stopRecord","onVoiceRecordEnd","playVoice","pauseVoice","stopVoice","onVoicePlayEnd","uploadVoice","downloadVoice"]
   });
   wx.ready(function(res){
     //switchBtnTo(['start']);
     changeWeixinShareData(0,'道具');
   });
   wx.error(function(res){
     //console.log(res);
     //alert(res);
   });
 });

 function changeWeixinShareData(index, prop){

   wx.onMenuShareTimeline({
     title: "<?php echo $info['nickname'];?>"+wxShareDataArray[index][1].replace("[XX]", prop),
     link: wxShareDataArray[index][3],
     imgUrl: wxShareDataArray[index][2],
     success: function () {
       // 用户确认分享后执行的回调函数
       //showAfterShareGuide();
     },
     cancel: function () {
       // 用户取消分享后执行的回调函数
       //showAfterShareGuide();
     }
   });

   wx.onMenuShareAppMessage({
     title: "<?php echo $info['nickname'];?>"+wxShareDataArray[index + 1][0],
     desc: wxShareDataArray[index + 1][1].replace("[XX]", prop),
     link: wxShareDataArray[index + 1][3],
     imgUrl: wxShareDataArray[index + 1][2],
     //type: '', // 分享类型,music、video或link，不填默认为link
     //dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
     success: function () {
       // 用户确认分享后执行的回调函数
       //showAfterShareGuide();
     },
     cancel: function () {
       // 用户取消分享后执行的回调函数
       //showAfterShareGuide();
     }
   });
 }
//]]>
</script><!-- layout -->
</body>
</html><!-- page processed by tidy, 0.004901 sec. -->