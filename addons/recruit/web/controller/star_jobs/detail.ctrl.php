<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/28 0028
 * Time: 13:46
 */
wl_load()->model('verify');
//保存公司信息
if ($op=="save_company_profile"){


//    if(check_phone($_POST['data']['company_mobile'])){
//        $data1['mobile'] =$_POST['data']['company_mobile'];
//    }
    $data1['fullname'] =$_POST['data']['company_name'];
    $data1['salt'] = mt_rand(100,999);
    $data1['password'] = pwd_hash("123456",$data1['salt']);
    $data1['mobile'] = mt_rand(100000,999999);
    $data1['createtime'] = time();
    $data1['utype'] = 2;
    $r = pdo_insert(WL."members",$data1);
    
    $data['uid'] = pdo_insertid();
    if($data['uid']){
        $data['nature'] = check_pasre($_POST['data']['company_nature'],"请填写公司性质");
        $data['companyname'] = check_pasre($_POST['data']['company_name'],"请填写公司名称");
        $data['headimgurl'] = check_pasre($_POST['data']['company_logo'],"请上传logo");
        $data['number'] = check_pasre($_POST['data']['company_scale'],"请填写公司规模");
        $data['industry'] = check_pasre($_POST['data']['company_industry'],"请填写所处行业");
        $data['city'] = check_pasre($_POST['data']['area'],"请填写所在地区");
        $data['slogan'] = $_POST['data']['slogan'];
        $data['introduce'] = check_pasre($_POST['data']['companymsg_introduce'],"请填写公司介绍");
        $data['city'] = check_pasre($_POST['data']['city'],"请选择城市");
        $data['address'] = $_POST['data']['address'];
        $data['city_area'] = check_pasre($_POST['data']['area'],"请选择区域");
        $atlas = check_pasre($_POST['data']['person_works'],"参数错误");
        $data['license'] = check_pasre($_POST['data']['company_zhizhao'],"参数错误");
        $data['idcard1'] = check_pasre($_POST['data']['company_shengfen1'],"参数错误");
        $data['idcard2'] = check_pasre($_POST['data']['company_shengfen2'],"参数错误");
        $data['atlas']="";
        foreach (explode(",",$atlas) as $list){
            $data['atlas'][] = file_transfer($list);
        }
        $data['atlas'] = array_filter($data['atlas']);
        $data['atlas'] = implode(",",$data['atlas']);
        $coordinate = explode(",",$_POST['data']['coordinate']);
        $data['retoate_x'] = $coordinate[0];
        $data['retoate_y'] = $coordinate[1];
        $data['tag'] = check_pasre($_POST['data']['company_welfare'],"参数错误");
        $data['website'] = $_POST['data']['company_url'];
        $data['updatetime'] = time();
        $result = pdo_insert(WL."company_profile",$data);
        if($result){
            call_back(1,"修改成功");
        }else{
            call_back(2,"修改失败");
        }
//        var_dump($data);exit();
//        $r = pdo_update(WL."company_profile",$data,array('uid'=>$_SESSION['uid']));
    }


//    var_dump($_POST);exit();
}



elseif ($_POST['token']=="edit"){
    if($data['uid']){
        $data = $_POST;
        $data['photolist'] = implode(",",$_POST['photolist']);
        $data['createtime'] = time();
        $r = insert_table($data,WL."star_hr");
        if($r){
            message('名企信息保存成功 ！', web_url('star_jobs/detail'), 'success');exit();
        }else{
            message('名企信息保存失败 ！', web_url('star_jobs/detail'), 'error');exit();
        }
    }else{
        message('参数错误 ！', web_url('star_jobs/detail'), 'error');exit();
    }


}
include wl_template('star_jobs/detail');exit();