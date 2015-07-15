<?php
/**
 * Created by PhpStorm.
 * User: run
 * Date: 2015/7/15
 * Time: 11:36
 */
include "wechat.class.php";
$options = array(
    'token'=>'vonvon', //填写你设定的key
    'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
    'appid'=>'wx519f23f4a45e8c37',//填写高级调用功能的appid
    'appsecret'=>'ea8f0b17b3a0882bf5fda7ed27758482' //填写高级调用功能的密钥
);
$weObj = new Wechat($options);
$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
$type = $weObj->getRev()->getRevType();
switch($type) {
    case Wechat::EVENT_SUBSCRIBE:
        $newsData = array(
            "0"=>array(
                'Title'=>'',
                'Description'=>'',
                'PicUrl'=>'',
                'Url'=>''
            ),
            "1"=>array(
                'Title'=>'',
                'Description'=>'',
                'PicUrl'=>'',
                'Url'=>''
            ),
        );
        $weObj->news($newsData)->reply();
        break;
    case Wechat::MSGTYPE_TEXT:
        $weObj->text("hello,I'm Aaron!")->reply();
        exit;
        break;
    case Wechat::MSGTYPE_EVENT:
        break;
    case Wechat::MSGTYPE_IMAGE:
        break;
    default:
        $weObj->text("help info")->reply();
}

//获取菜单操作:
$menu = $weObj->getMenu();
//设置菜单
$newmenu =  array(
        "button"=>array(
            0=>array(
                'type'=>'click',
                'name'=>'最新测试',
                'sub_button'=>array(
                    0=>array('type'=>'view','name'=>'','url'=>''),
                    1=>array('type'=>'view','name'=>'','url'=>''),
                    2=>array('type'=>'view','name'=>'','url'=>''),
                    3=>array('type'=>'view','name'=>'','url'=>''),
                    4=>array('type'=>'view','name'=>'','url'=>'')
                )
            ),
            1=>array(
                'type'=>'click',
                'name'=>'人气测试',
                'sub_button'=>array(
                    0=>array('type'=>'view','name'=>'','url'=>''),
                    1=>array('type'=>'view','name'=>'','url'=>''),
                    2=>array('type'=>'view','name'=>'','url'=>''),
                    3=>array('type'=>'view','name'=>'','url'=>''),
                    4=>array('type'=>'view','name'=>'','url'=>'')
                )
            ),
            2=>array(
                'type'=>'view',
                'name'=>'更多测试',
                'url'=>'http://cn.vonvon.net'
            )
        )
);
$result = $weObj->createMenu($newmenu);