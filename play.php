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

$data = $weObj->getOauthRefreshToken();

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>VonVon录音小游戏</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0"/>
    <meta charset="utf8">
    <style type="text/css">
        body {
            background-color: #333;
            color: #fff;
            padding: 0;
            margin: 0;
            font-size: 16px;
        }

        a {
            text-decoration: none
        }

        a:hover {
            color: #37a5be;
        }

        img {
            padding: 0;
            margin: 0;
        }

        .page-container {
            max-width: 500px;
            margin: 0 auto;
        }

        .title {
            font-size: 30px;
            font-weight: bold;
            padding: 30px 0;
            margin: 0;
            text-align: center
        }

        .tips, .bottomtext {
            font-size: 16px;
            margin: 10px auto;
            text-align: center;
            color: #fff;
        }

        .tips span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }

        .icon {
            width: 140px;
            height: 160px;
            margin: 0 auto;
            text-align: center;
            overflow: hidden;
        }

        img.mouth {
            height: 128px;
            width: 128px;
            margin: 16px 0;
        }

        a.play {
            margin: 32px auto;
            width: 96px;
            height: 96px;
            display: block;
        }

        a.play img {
            height: 96px;
            width: 96px;
            margin: 0;
            padding: 0;
        }

        img.playgif {
            margin: 36px auto;
            width: 86px;
            height: 86px;
        }

        .btn {
            margin: 0 auto;
            padding: 10px 0 0;
            text-align: center;
        }

        .btn a.gray {
            color: #727272;
            background-color: #fff;
        }

        .btn a.green {
            color: #FFF;
            background-color: #45c01a;
        }

        .btn a.green, .btn a.gray {
            border-color: #a4a4a4;
            border-radius: 3px;
            display: block;
            font-size: 18px;
            height: 40px;
            line-height: 40px;
            margin: auto;
            text-align: center;
            width: 150px;
            margin-bottom: 15px;
        }

        .bg {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1987;
            width: 100%;
            height: 100%;
            background: #000;
            filter: alpha(opacity=85);
            opacity: 0.85;
        }

        img.share {
            position: fixed;
            top: 0.4rem;
            right: 1.2rem;
            z-index: 1988;
            width: 16rem;
            height: 3.2rem;
        }

        .tuiguang {
            border: 1px solid #999;
            height: 50px;
            color: #000;
            background: #FFF;
            border-radius: 2px;
            margin: 60px 15px 20px;
            padding: 4px 0 4px 58px;
            position: relative;
            -webkit-box-shadow: #666 0px 0px 5px;
            -moz-box-shadow: #666 0px 0px 4px;
            box-shadow: #666 0px 0px 5px;

        }

        .tuiguang a img {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 46px;
            height: 46px;
            border-radius: 50%
        }

        .tuiguang a span {
            display: block
        }

        .tuiguang a span.wxname {
            color: #11891E;
            font-weight: bold;
            line-height: 25px;
            text-align: left;
            padding-right:85px
        }

        .tuiguang a span.wxname i {
            background: url(http://ww3.sinaimg.cn/mw1024/546f06cegw1eojl2p5lzij20170170si.jpg) 4px center no-repeat;
            font-style: normal;
            font-weight: normal;
            padding-left: 18px;
            font-size: 0.8rem;
            color: #AAA;
            background-size: 12px 12px;
        }

        .tuiguang a span.wxdescription {
            text-align: left;
            font-size: 0.8rem;
            line-height: 25px;
            color: #888888;
            white-space: nowrap;
        }

        .tuiguang a span.addbutton {
            width: 75px;
            height: 32px;
            background: #06BF04;
            border: 1px solid #2FAD2E;
            position: absolute;
            right: 6px;
            top: 11px;
            color: #fff;
            text-align: center;
            line-height: 35px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 3px;
        }

        a.ad, a.ad:hover {
            color: #fff;
        }
    </style>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <script src='http://res.wx.qq.com/open/js/jweixin-1.0.0.js'></script>
    <script type="text/javascript">

        var voiceId = getQueryString('Record');
        var sec = getQueryString('s');

        function getQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null)
                return decodeURI(r[2]);
            return '';
        }
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "startRecord", "stopRecord", "onVoiceRecordEnd", "playVoice", "pauseVoice", "stopVoice", "onVoicePlayEnd", "uploadVoice", "downloadVoice"]
        });

        wx.ready(function (res) {
            downloadVoice(voiceId);
            wx.onMenuShareTimeline({
                title: "<?php echo $info['nickname'];?>" + "录制了" + sec +"秒" + "朋友圈语音,你也来试试!",
                link: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Fplay.php%3FRecord%3d"+voiceId+"%26s%3d"+sec+"&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect",
                imgUrl: "<?php echo $info['headimgurl'];?>",
                success: function () {
                    // 用户确认分享后执行的回调函数

                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数

                }
            });

            wx.onMenuShareAppMessage({
                title: "<?php echo $info['nickname'];?>" + "播放语音",
                desc: "秒",
                link: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Fplay.php%3FRecord%3d"+voiceId+"%26s%3d"+sec+"&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect",
                imgUrl: "http://139.129.117.49/vonvonWX/img/yy.jpg",
                //type: '', // 分享类型,music、video或link，不填默认为link
                //dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数

                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数

                }
            });
        });
        wx.error(function (res) {

        });

        var last_voice_localId = "";
        var voice_record_time = ;
        function downloadVoice(serverId) {
            wx.downloadVoice({
                serverId: serverId, // 需要下载的音频的服务器端ID，由uploadVoice接口获得
                isShowProgressTips: 0, // 默认为1，显示进度提示
                success: function (res) {
                    var localId = res.localId; // 返回音频的本地ID
                    last_voice_localId = localId;
                    setTimeout('playVoiceByUser()', 500);
                }
            });
        }
        var play_time_ti;
        var is_playing = false;
        function playVoice(id) {
            is_playing = true;
            play_time_ti = setInterval(function () {
                var tt = $('#div_tips').text().replace("s", "");
                var ss = tt * 1;
                $('#div_tips').text((ss > 1 ? ss - 1 : 0) + "s");
            }, 1000);

            setTimeout(function () {
                is_playing = false;
                $("#img_recording").hide();
                $('#img_play').show();
                $('#div_tips').text(voice_record_time * 1 + "s");

                if (play_time_ti) {
                    clearInterval(play_time_ti);
                }

            }, voice_record_time * 1000);
            wx.playVoice({
                localId: id// 需要播放的音频的本地ID，由stopRecord接口获得
            });

        }

        function playVoiceByUser() {
            if (is_playing) return;
            playVoice(last_voice_localId);
        }
    </script>
</head>
<body ontouchmove="event.preventDefault()">
<div class="page-container"></div>
<div class="title">播放语音</div>
<div class="icon">
    <a class="play" href="javascript:playVoiceByUser()" id="img_play" style="display:none"><img
            src="img/play.png"></a>
    <img src="img/play.gif" class="playgif" id="img_recording">
</div>
<div class="tips" id="div_tips">s</div>
<div class="btn">

    <a class="green"
       href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Fly.php&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect">我也要发语音</a>

    <div class="tuiguang"><a href="http://mp.weixin.qq.com/s?__biz=MzAwNDQ4OTAwNw==&mid=209230536&idx=1&sn=55aa78162626539328dd2ab9dfa0a96d#rd"><img src="http://img01.sogoucdn.com/app/a/100520090/oIWsFt970so3iyYPrge0G73H-owI"><span class="wxname">VonVon测试<i>新兴于韩国,是社交媒体上最具爆点的测试制造者</i></span><span class="addbutton">关注</span></a></div>
</div>
</body>
</html>