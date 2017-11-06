<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22 0022
 * Time: 17:23
 */
defined('IN_IA') or exit('Access Denied');

if($op=="index"){
    $company = m('company')->get_profile($_SESSION['uid']);
    if(!$company['atlas'] ||!$company['introduce']){
        include wl_template("company/company_nomessage");
    }else{
        include wl_template("company/company_message");
    }
}


elseif ($op=="first_index"){

    include wl_template("company/company_nomessage");
}

//跟换头像
elseif ($op=="hedimgurl_upload"){

    $worksurl = base64_upload($_POST['file']);
    call_back(1,$worksurl);
}

//跟换添加公司图集
elseif ($op=="change_company_atlas"){
    $atlas = upload_img($_FILES);
    call_back(1,$atlas);
}

//修改公司基本信息
elseif ($op=="save_base"){
//    var_dump($_POST);exit();
    $data['nature'] = check_pasre($_POST['data']['company_nature'],"1");
    $data['headimgurl'] = check_pasre($_POST['data']['company_logo'],"1");
    $data['number'] = check_pasre($_POST['data']['company_scale'],"2");
    $data['industry'] = check_pasre($_POST['data']['company_industry'],"3");
    $data['city'] = check_pasre($_POST['data']['company_area'],"4");
    $data['slogan'] = check_pasre($_POST['data']['slogan'],"5");
    $data['updatetime'] = time();
    $r = pdo_update(WL."company_profile",$data,array('uid'=>$_SESSION['uid']));
    if($r){
        call_back(1,"ok");
    }else{
        call_back(2,"no");
    }
}

//保存公司介绍
elseif ($op=="save_introduce"){
//    var_dump($_POST);exit();
    if($_POST['data']['companymsg_introduce']){
        $introduce = $_POST['data']['companymsg_introduce'];
        $r = pdo_update(WL."company_profile",array('introduce'=>$introduce,'updatetime'=>time()),array('uid'=>$_SESSION['uid']));
        if($r){
            call_back(1,$introduce);
        }else{
            call_back(2,"no");
        }
    }
}

//保存公司地址
elseif ($op=="save_address"){
//    var_dump($_POST);exit();
    $data['city'] = check_pasre($_POST['data']['city'],"请输入城市");
    $data['city_area'] = check_pasre($_POST['data']['area'],"请输入城市区域");
    $data['address'] = $_POST['data']['address'];
    $data['district'] = $_POST['data']['undefined'];
    $coordinate = explode(",",$_POST['data']['coordinate']);
    $data['retoate_x'] = $coordinate[0];
    $data['retoate_y'] = $coordinate[1];
    $data['updatetime'] = time();
    $r = pdo_update(WL."company_profile",$data,array('uid'=>$_SESSION['uid']));
    if($r){
        call_back(1,"ok");
    }else{
        call_back(2,"no");
    }
}

//保存福利标签
elseif ($op=="save_tag"){
    $data['tag'] = check_pasre($_POST['data']['company_welfare'],"参数错误");
    $data['updatetime'] = time();
    $r = pdo_update(WL.'company_profile',$data,array('uid'=>$_SESSION['uid']));
    if($r){
        call_back(1,"ok");
    }else{
        call_back(2,"no");
    }
}

//保存公司网站
elseif ($op=="save_website"){
//    var_dump($_POST);exit();
    $data['website'] = check_pasre($_POST['data']['company_url'],"请输入公司网址");
    $data['updatetime'] = time();
    $r = pdo_update(WL.'company_profile',$data,array('uid'=>$_SESSION['uid']));
    if($r){
        call_back(1,"ok");
    }else{
        call_back(2,"no");
    }
}


//保存公司信息
elseif ($op=="save_company_profile"){
//    var_dump($_POST);exit();
    $data['nature'] = check_pasre($_POST['data']['company_nature'],"1");
    $data['headimgurl'] = check_pasre($_POST['data']['company_logo'],"2");
    $data['number'] = check_pasre($_POST['data']['company_scale'],"3");
    $data['industry'] = check_pasre($_POST['data']['company_industry'],"4");
    $data['city'] = check_pasre($_POST['data']['area'],"5");
    $data['slogan'] = check_pasre($_POST['data']['slogan'],"参数错误6");
    $data['introduce'] = check_pasre($_POST['data']['companymsg_introduce'],"参数错误7");
    $data['city'] = check_pasre($_POST['data']['city'],"参数错误8");
    $data['address'] = check_pasre($_POST['data']['address'],"参数错误9");
    $data['city_area'] = check_pasre($_POST['data']['area'],"参数错误0");
    $data['atlas'] = check_pasre($_POST['data']['person_works'],"参数错误");
    $coordinate = explode(",",$_POST['data']['coordinate']);
    $data['retoate_x'] = $coordinate[0];
    $data['retoate_y'] = $coordinate[1];
    $data['tag'] = check_pasre($_POST['data']['company_welfare'],"参数错误");
    $data['website'] = check_pasre($_POST['data']['company_url'],"参数错误");
    $data['updatetime'] = time();
    $r = pdo_update(WL."company_profile",$data,array('uid'=>$_SESSION['uid']));
    if($r){
        call_back(1,"ok");
    }else{
        call_back(2,"no");
    }
//    var_dump($_POST);exit();
}


//保存公司图集
elseif ($op=="save_imgbox"){
    if($_POST['data']['person_works']){
        $person_works = $_POST['data']['person_works'];
        $person_works = explode(",",$person_works);
        foreach ($person_works as $list){
            if(strpos($list,"/temp/")){
                $new_list = str_replace("/temp/","/file/",$list);
                rename($_SERVER['DOCUMENT_ROOT'].$list,$_SERVER['DOCUMENT_ROOT'].$new_list);
            }
        }
        $person_works = str_replace("/temp/","/file/",$_POST['data']['person_works']);
        $r = pdo_update(WL."company_profile",array('atlas'=>$person_works,'updatetime'=>time()),array('uid'=>$_SESSION['uid']));
        if($r){
            call_back(1,"ok");
        }else{
            call_back(2,"no");
        }

    }

}



