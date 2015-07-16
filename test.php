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
//$info['nickname'] = iconv('gbk2312','utf8',$info['nickname']);

require_once "js/jssdk.php";
$jssdk = new JSSDK("yourAppID", "yourAppSecret");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aaron's demo</title>
</head>
<body>
<?php
echo "Your nickname is ".$info['nickname']."<br />Your sex is ".$info['sex']."<br />Your city is ".$info['city']."<br />Your province is ".$info['province']."<br />Your country is ".$info['country']."<br />Now is ".date("Y-m-d H:i:s",time())."<br />";

echo "<img src='".$info['headimgurl']."'>";
?>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: true,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline'
        ]
    });
    wx.ready(function () {
        // 在这里调用 API
        wx.onMenuShareTimeline({
            title: <?php echo $info['nickname'].', come on!';?>, // 分享标题
            link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Ftest.php&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect', // 分享链接
            imgUrl: <?php echo $info['headimgurl'];?>, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                alert('已分享');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                alert('已取消');
            }
        });
    });
</script>
</html>