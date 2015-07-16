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

require_once "js/jssdk.php";
$jssdk = new JSSDK("wx519f23f4a45e8c37", "ea8f0b17b3a0882bf5fda7ed27758482");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>VonVon录音小游戏</title><meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0" />
<meta charset="utf8">
    <style type="text/css">
        body {
            background-color:#333;
            color:#fff;
            padding:0;
            margin:0;
            font-size:16px;
        }
        a {
            text-decoration:none
        }
        a:hover {
            color:#37a5be;
        }
        img {
            padding:0;
            margin:0;
        }
        .page-container {
            max-width:500px;
            margin:0 auto;
        }
        .title {
            font-size:30px;
            font-weight:bold;
            padding:30px 0;
            margin:0;
            text-align:center
        }
        .tips, .bottomtext {
            font-size: 16px;
            margin:10px auto;
            text-align: center;
            color: #fff;
        }
        .tips span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size:14px;
        }
        .icon {
            width:140px;
            height:160px;
            margin:0 auto;
            text-align:center;
            overflow:hidden;
        }
        img.mouth {
            height:128px;
            width:128px;
            margin:16px 0;
        }
        a.play {
            margin:32px auto;
            width:96px;
            height:96px;
            display:block;
        }
        a.play img {
            height:96px;
            width:96px;
            margin:0;
            padding:0;
        }
        img.playgif {
            margin:36px auto;
            width:86px;
            height:86px;
        }
        .btn {
            margin:0 auto;
            padding:10px 0 0;
            text-align:center;
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
            margin-bottom:15px;
        }
        .bg { position:fixed; top:0; left:0; z-index:1987; width:100%; height:100%; background:#000; filter:alpha(opacity=85); opacity:0.85;}
        img.share { position:fixed; top:0.4rem; right:1.2rem;z-index:1988; width:16rem; height:3.2rem;}
        .tuiguang {
            border:1px solid #999;
            height:50px;
            color:#000;
            background:#FFF;
            border-radius:2px;
            margin:60px 15px 20px;
            padding:4px 0 4px 58px;
            position:relative;
            -webkit-box-shadow: #666 0px 0px 5px; -moz-box-shadow: #666 0px 0px 4px; box-shadow: #666 0px 0px 5px;

        }
        .tuiguang a img { position:absolute; top:6px; left:6px; width:46px; height:46px;border-radius:50%}
        .tuiguang a span { display:block}
        .tuiguang a span.wxname{ color:#11891E; font-weight:bold;  line-height:25px; text-align: left; padding-right:85px}
        .tuiguang a span.wxname i{ background:url(http://ww3.sinaimg.cn/mw1024/546f06cegw1eojl2p5lzij20170170si.jpg) 4px center  no-repeat; font-style:normal; font-weight:normal; padding-left:18px; font-size:0.8rem; color:#AAA; background-size:12px 12px;}
        .tuiguang a span.wxdescription { font-size:0.8rem; line-height:25px;	color:#888888;white-space:nowrap; }
        .tuiguang a span.addbutton{ width:75px; height:32px; background:#06BF04; border:1px solid #2FAD2E; position:absolute; right:6px; top:11px; color:#fff; text-align:center; line-height:35px; font-size:15px; font-weight:bold;border-radius:3px;}
        a.ad ,  a.ad:hover { color:#fff;}
    </style>

</head>
<body ontouchmove="event.preventDefault()">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type="text/javascript">

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
    function uploadVoice(localId) {
        wx.uploadVoice({
            localId: localId, // 需要上传的音频的本地ID，由stopRecord接口获得
            isShowProgressTips: 1, // 默认为1，显示进度提示
            success: function (res) {
                var serverId = res.serverId; // 返回音频的服务器端ID
                $("#txt_serverID").val(serverId);
                $("#div_friend").show();
                $("#div_friendtxt").show();
                wxShareDataArray[3] = serverId;
                changeWeixinShareData();
            }
        });
    }

    var last_voice_localId;
    function onRecordDone(localId) {

        voice_record_time = Math.ceil(((new Date()).getTime() - voice_record_start) / 1000);
        $("#div_tips").text(voice_record_time * 1 + "s");
        last_voice_localId = localId;
        wxShareDataArray[2] = voice_record_time * 1 + "\"";

        setTimeout(function () {
            uploadVoice(localId);
        }, 1000);

        playVoice(localId);

    }

    var isRecording = false;
    function startRecord() {
        if (isRecording) return;
        $("#img_mouth").hide();
        $("#div_start").hide();
        $('#img_play').hide();
        $("#img_recording").show();
        $("#div_tips").show();
        $("#div_tips").text("正在录音...");
        $("#div_stop").show();
        $("#div_friend").hide();
        $("#div_friendtxt").hide();
        isRecording = true;
        wx.onVoiceRecordEnd({
            // 录音时间超过一分钟没有停止的时候会执行 complete 回调
            complete: function (res) {
                var localId = res.localId;

                isRecording = false;
                onRecordDone(localId);
            }
        });


        voice_record_time = 0;
        voice_record_start = (new Date()).getTime();

        wx.startRecord({
            success: function () {
                isRecording = false;
                voice_record_start = (new Date()).getTime();
            },
            cancel: function () {
                isRecording = false;
            }
        });

    }


    function stopRecord() {
        isRecording = false;

        $("#div_stop").hide();
        $("#div_start").show();
        wx.stopRecord({
            success: function (res) {
                var localId = res.localId;
                onRecordDone(localId);
            }
        });
    }

    function playRecord() {
        $("#img_recording").show();
        $('#img_play').hide();
        playVoice(last_voice_localId);
    }

    function restartRecord() {
        startRecord();
    }
    function showShareInfo() {
        $("#div_share").show();
    }
    function showAfterShareGuide() {
        $('#div_share').hide();
    }
</script>
<!-- body append -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>

<script type="text/javascript">
    var wxShareDataArray = ["朋友圈也能发语音了！", "http://139.129.117.49/vonvonWX/img/yy.jpg", "0\"", ""];

    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "startRecord", "stopRecord", "onVoiceRecordEnd", "playVoice", "pauseVoice", "stopVoice", "onVoicePlayEnd", "uploadVoice", "downloadVoice"]
    });
	wx.ready(function () {
           changeWeixinShareData();
    });
           wx.error(function (res) {

    });



    function changeWeixinShareData() {

        wx.onMenuShareTimeline({
            title: "<?php echo $info['nickname'];?>" + "对你说了" + wxShareDataArray[2] +"秒" + ",快来听听吧!",
            link: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx519f23f4a45e8c37&redirect_uri=http%3A%2F%2F139.129.117.49%2FvonvonWX%2Fplay.php%3FRecord%3d" + wxShareDataArray[3] + "%26s%3d" + wxShareDataArray[2].replace("\"", "") + "&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect",
            imgUrl: "<?php echo $info['headimgurl'];?>",
            success: function () {
                // 用户确认分享后执行的回调函数
                showAfterShareGuide();
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                showAfterShareGuide();
            }
        });

        wx.onMenuShareAppMessage({
            title: "<?php echo $info['nickname'];?>" + "对你说了" + wxShareDataArray[2] +"秒" + "快来听听吧!",
            desc: wxShareDataArray[2],
            link: "http://139.129.117.49/vonvonWX/play.php?Record=" + wxShareDataArray[3] + "&s=" + wxShareDataArray[2].replace("\"", ""),
            imgUrl: "<?php echo $info['headimgurl'];?>",
            //type: '', // 分享类型,music、video或link，不填默认为link
            //dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                showAfterShareGuide();
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                showAfterShareGuide();
            }
        });
    }

</script>
<div class="page-container">
    <div class="title">录制语音</div>
    <div class="icon">
        <img src="<?php echo $info['headimgurl'];?>" class="mouth" id = "img_mouth">
        <a class="play" href="javascript:playRecord()" id = "img_play" style="display:none"><img src="img/play.png"></a>
        <img src="img/play.gif" class="playgif" id="img_recording" style="display:none">
    </div>
    <div class="tips" id="div_tips" >&nbsp;</div>
    <div class="btn">
        <a href="javascript:restartRecord()" class="gray" id="div_start">开始录音</a>
        <a class="green" href="javascript:stopRecord()" id="div_stop" style="display:none">停止录音</a>
        <a class="green" href="javascript:showShareInfo()" id="div_friend" style="display:none">发到朋友圈</a></div>
    <div class="bottomtext" id="div_friendtxt" style="display:none">已保存，可分享</div>
</div>
<div id="div_share" style="display:none">
    <div class="bg" onclick="showAfterShareGuide()"></div>
    <img src="img/share.png" class="share" >

</div>
<div class="tuiguang"><a href="http://mp.weixin.qq.com/s?__biz=MzAwNDQ4OTAwNw==&mid=209230536&idx=1&sn=55aa78162626539328dd2ab9dfa0a96d#rd"><img src="http://img01.sogoucdn.com/app/a/100520090/oIWsFt970so3iyYPrge0G73H-owI"><span class="wxname">VonVon测试<i>新兴于韩国,是社交媒体上最具爆点的测试制造者</i></span><span class="addbutton">关注</span></a></div>
<input type=text id="txt_serverID" style="display:none" />
</body>
</html>