<?php
defined('IN_IA') or exit('Access Denied');


if($_GPC['uid']){
    $member = m('member')->get_member($_GPC['uid']);
    $resume = m("resume")->get_resume($_GPC['uid']);

    if(trim($resume['work_experience'])){
        $work_experience = unserialize($resume['work_experience']);
    }else{
        $work_experience = array();
    }

    if(trim($resume['edu_experience'])){
        $edu_experience = unserialize($resume['edu_experience']);
    }else{
        $edu_experience = array();
    }

    if(trim($resume['personal_works'])){
        $resume['personal_works'] = unserialize($resume['personal_works']);
        $personal_works = array();
        foreach ($resume['personal_works'] as $list){
            $person_works = explode(",",$list['person_works']);
            $list['thumb'] = $person_works[0];
            $personal_works[] = $list;
        }
    }else{
        $personal_works = array();
    }

    if(trim($resume['honor'])){
        $honor = unserialize($resume['honor']);
    }else{
        $honor = array();
    }
}
if($op=="index"){
//    $data['template'] = "扁平化风格";
//    $data['template'] = "简约风格";
//    $data['template'] = "游戏风格";
//    $data['template'] = "水墨风格";
//    $data['createtime'] = time();
//    insert_table($data,WL."resume_template");
//    var_dump($honor);exit();
    if($_POST['template_id'] && $_SESSION['utype']==1){
        $r = pdo_update(WL."resume",array('template_id'=>$_GPC['template_id']),array('uid'=>$_SESSION['uid']));
        call_back(1,"ok");
    }
    elseif($_SESSION['utype']==2){
//        echo "resume_template/resume_preview".$resume['template_id'];exit();
        $jobs = pdo_fetchall("select id,jobs_name from ".tablename(WL."jobs")." where uid=".$_SESSION['uid']);
        $collect_resume = pdo_fetch("select id from ".tablename(WL.'collect_resume')." where uid=".$_SESSION['uid']." and puid=".$_GPC['uid']);
        if($_GPC['apply_id']){
            $status = pdo_fetch("select status from ".tablename(WL."jobs_apply")." where id=".$_GPC['apply_id']);
            $status = $status['status'];
        }

        include wl_template("resume_template/resume_preview".$resume['template_id']);
    }else{
        include wl_template("resume_template/resume_preview".$resume['template_id']);
    }
}

elseif ($op=="print"){
    include wl_template("resume/resume_print");
}