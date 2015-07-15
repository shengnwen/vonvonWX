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
    case Wechat::MSGTYPE_TEXT:
        $openid = $weObj->getRev()->getRevFrom();
        $weObj->text("hello,I'm Aaron! Your openid is".$openid)->reply();
        exit;
        break;
    case Wechat::MSGTYPE_EVENT:
        $event = $weObj->getRev()->getRevEvent();
        switch($event['event']){
            case 'subscribe':
                $subscribe = array(
                    "0"=>array(
                        'Title'=>'Welcome to Vonvon!',
                        'Description'=>'Vonvon作为国际化的SNS社交媒体，从2015年1月起，在全世界已经拥有1亿以上的 用户。现在已在韩国，中国，台湾，泰国，越南，印尼，美国，巴西，西班牙等国家 开放。将来会拓展到更多的国家，并且会创作更多有趣的主题测试。',
                        'PicUrl'=>'http://cdn-cn-static-dr.vonvon.net/images/cn/recruit_main.jpg',
                        'Url'=>'http://cn.vonvon.net/'
                    ),
                    "1"=>array(
                        'Title'=>'盗墓笔记测试——你是南派还是北派',
                        'Description'=>'你看过盗墓笔记吗？你知道盗墓人士中分南派和北派吗？来测一下你是属于什么派的吧？',
                        'PicUrl'=>'http://cdn-cn.vonvon.net/vonvon-cn-real/editor/1436839209469-SArBr8o9DJoXcpLx.jpg',
                        'Url'=>'http://cn.vonvon.net/quiz/424'
                    )
                );
                $weObj->news($subscribe)->reply();
                break;
            case 'CLICK':
                switch($event['key']){
                    case 'god':
                        $god = array(
                            "0"=>array(
                                'Title'=>'神制作我的时候【第二弹夏日特制版】',
                                'Description'=>'神制作我的时候【第二弹夏日特制版】',
                                'PicUrl'=>'http://cdn-cn.vonvon.net/vonvon-cn-real/editor/1435891488403-VNAPCjjJcyU3cqxw.jpg',
                                'Url'=>'http://cn.vonvon.net/quiz/380'
                            ),
                            "1"=>array(
                                'Title'=>'神制作我的时候',
                                'Description'=>'神制作我的时候',
                                'PicUrl'=>'http://cdn-cn.vonvon.net/vonvon-cn-real/editor/mig/2015-06-11/a63b5eb123914f85a5e15ede5561c80b',
                                'Url'=>'http://cn.vonvon.net/quiz/341'
                            )
                        );
                        $weObj->news($god)->reply();
                        break;
                    case 'game':
                        $game = array(
                            "0"=>array(
                                'Title'=>'彩色方块',
                                'Description'=>'彩色方块',
                                'PicUrl'=>'http://cdn-cn.vonvon.net/vonvon-cn-real/editor/mig/2015-06-29/aa40c3ab06a84125b5cf6eda3725f6f0',
                                'Url'=>'http://cn.vonvon.net/quiz/394'
                            ),
                            "1"=>array(
                                'Title'=>'色盲测试',
                                'Description'=>'色盲测试',
                                'PicUrl'=>'http://cdn-cn.vonvon.net/vonvon-cn-real/editor/mig/2015-07-06/e5cb7e65b69d4239a9419a223e0e51b3',
                                'Url'=>'http://cn.vonvon.net/quiz/391'
                            )
                        );
                        $weObj->news($game)->reply();
                        break;
                    default:
                        $weObj->text("click info")->reply();
                }
                break;
            default:
                $weObj->text("event info")->reply();
        }
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
                    0=>array('type'=>'click','name'=>'【神制作】系列','key'=>'god'),
                    1=>array('type'=>'view','name'=>'盗墓笔记','url'=>'http://cn.vonvon.net/quiz/424'),
                    2=>array('type'=>'view','name'=>'你的身体结构','url'=>'http://cn.vonvon.net/quiz/421'),
                    3=>array('type'=>'view','name'=>'我的右脑有多聪明','url'=>'http://cn.vonvon.net/quiz/387'),
                    4=>array('type'=>'view','name'=>'【门萨】IQ测试','url'=>'http://cn.vonvon.net/quiz/318')
                )
            ),
            1=>array(
                'type'=>'click',
                'name'=>'人气测试',
                'sub_button'=>array(
                    0=>array('type'=>'view','name'=>'神在制作我的时候','url'=>'http://cn.vonvon.net/quiz/341'),
                    1=>array('type'=>'view','name'=>'多久后我才脱单','url'=>'http://cn.vonvon.net/quiz/319'),
                    2=>array('type'=>'view','name'=>'最适合我的别名','url'=>'http://cn.vonvon.net/quiz/361'),
                    3=>array('type'=>'view','name'=>'我的相关关键字','url'=>'http://cn.vonvon.net/quiz/364'),
                    4=>array('type'=>'click','name'=>'vonvon游戏','key'=>'game')
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