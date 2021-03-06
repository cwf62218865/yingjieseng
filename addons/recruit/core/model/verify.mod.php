<?php

defined('IN_IA') or exit('Access Denied');

/*
 * 验证手机号
 * kind 类型 1验证是否存在，2表示其他
 */
function check_phone($mobile,$kind=1){
    if(!(trim($mobile))){
        call_back(2,"请输入联系人手机号码");
    }
    if(preg_match("/^1[34578]\d{9}$/", $mobile)){
        if($kind==1){
            $mobile = pdo_fetch("select mobile from ".tablename(WL."members")." where mobile=".$mobile);
            if($mobile){
                call_back(4,"该手机号已被注册");
            }else{
                return true;
            }
        }else{
            return true;
        }
    }else{
        call_back(2,"请输入正确的手机号");
    }
}

/*
 *验证用户是否存在
 */
function member_exists($username){

    $username = trim($username);
    $member = pdo_fetch("select * from ".tablename(WL."members")." where mobile='".$username."' or username='".$username."'");
    if($member){
        return $member;
    }else{
        call_back(4,"该用户不存在");
    }
}


/*
 * 发送短信验证码
 */
function send_codes($phone){
    wl_load()->model('sms');
    unset($_SESSION['phone_code']);
    if(check_phone($phone)){
        if(!$_SESSION['last_sendtime'])
        {
            $_SESSION['phone_code']=mt_rand(1000,9999);
            $_SESSION['last_sendtime']=time();
            if(sendSms($phone,$_SESSION['phone_code'])){
                call_back(1,"ok");
            }
        }
        else
        {
            if ( (time() - $_SESSION['last_sendtime']) >50 )
            {

                $_SESSION['phone_code']=mt_rand(1000,9999);
                $_SESSION['last_sendtime']=time();
                if(sendSms($phone,$_SESSION['phone_code'])){
                    call_back(1,"ok");
                }
            }else{
                return false;
            }
        }
        exit();
    }
}

function GetIpLookup($ip = ''){
    if(empty($ip)){
        return '';
    }
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
    if(empty($res)){ return false; }
    $jsonMatches = array();
    preg_match('#\{.+?\}#', $res, $jsonMatches);
    if(!isset($jsonMatches[0])){ return false; }
    $json = json_decode($jsonMatches[0], true);
    if(isset($json['ret']) && $json['ret'] == 1){
        $json['ip'] = $ip;
        unset($json['ret']);
    }else{
        return false;
    }
    return $json;
}