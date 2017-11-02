<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18 0018
 * Time: 16:41
 */

class resume{

    /*
     * 获取一行简历
     */
    public function get_resume($uid){
        $resume = pdo_fetch("select * from ".tablename(WL.'resume')." where uid=".$uid);
        $edu_experience = unserialize($resume['edu_experience']);
        $education = "";
        $id = "";
        $edu = array('专科以下','专科','本科','硕士','博士','博士以上');
        $arr_edu = array_flip($edu);
        foreach ($edu_experience as $key=>$list){
            $value = $list['edu_district'];
            if(empty($education)){
                $education = $arr_edu[$value];
                $id = $key;
            }else{
                if($arr_edu[$value]>$education){
                    $education = $arr_edu[$value];
                    $id = $key;
                }
            }
        }
       $resume['education'] = $edu[$education];
        $resume['arr_education'] = $edu_experience[$id];
        $work_experience = unserialize($resume['work_experience']);

        $work_time = "";
        foreach ($work_experience as $list){
//            $list['job_starttime'] = str_replace("月","",str_replace("年","-",$list['job_starttime']));
//            $time = strtotime($list['job_starttime']);
//            if(empty($work_time)){
//                $work_time = $time;
//            }else{
//                if($time<$work_time){
//                    $work_time = $time;
//                }
//            }
            $work_time =$work_time+($list['job_endtime'] - $list['job_starttime']);
        }
        if($work_time){
            $resume['work_time'] =ceil($work_time/31536000);
        }
//        $resume['work_time'] =  date('Y')-date('Y',$work_time);
        return $resume;
    }

    /*
     * 我投递过的职位
     * status 0表示所有 1表示投递申请 2表示面试邀请
     */
    public function jobs_apply($uid,$page=1,$status=1){
        if($page==-1){
            $limit = "";
        }else{
            $limit = " limit ".(($page-1)*6).",6";
        }
        if($status==1){
            $jobs_apply = pdo_fetchall("select * from ".tablename(WL."jobs_apply")." where direction=2 and puid=".$uid." order by createtime desc ".$limit);
        }elseif($status==2){
            $jobs_apply = pdo_fetchall("select * from ".tablename(WL."jobs_apply")." where status=3 and puid=".$uid." order by createtime desc ".$limit);
        }elseif ($status==0){
            $jobs_apply = pdo_fetchall("select * from ".tablename(WL."jobs_apply")." where puid=".$uid." order by createtime desc ".$limit);
        }

        $jobs = "";
        foreach ($jobs_apply as $key=>$list){
            $jobs[$key] = pdo_fetch("select * from ".tablename(WL.'jobs')." where id=".$list['jobs_id']);
            $jobs[$key]['status'] = $list['status'];
            $jobs[$key]['apply_id'] = $list['id'];
            $jobs[$key]['direction'] = $list['direction'];
            $jobs[$key]['createtime'] = $list['createtime'];
            $jobs[$key]['offer'] = $list['offer'];
            if($list['status']==3){
                $jobs[$key]['interview'] = pdo_fetch("select * from ".tablename(WL.'interview')." where jobs_id=".$list['jobs_id']." and resume_id=".$list['resume_id']);
            }
            $company_profile = pdo_fetch("select * from ".tablename(WL."company_profile")." where uid=".$list['uid']);
            $jobs[$key]['tag'] = $company_profile['tag'];
            $jobs[$key]['headimgurl'] = $company_profile['headimgurl'];
            $jobs[$key]['retoate_x'] = $company_profile['retoate_x'];
            $jobs[$key]['retoate_y'] = $company_profile['retoate_y'];
            $jobs[$key]['city'] = $company_profile['city'];
        }
        return $jobs;
    }

    public function jobs_interview($uid,$page=1){
        $limit = " limit ".(($page-1)*6).",6";
        $orderby = " order by createtime desc";
        $jobs_apply = pdo_fetchall("select * from ".tablename(WL."jobs_apply")." where status=3 and puid=".$uid.$orderby.$limit);
//        var_dump($jobs_apply);exit();
        $jobs = "";
        foreach ($jobs_apply as $key=>$list){
            $jobs[$key] = m('jobs')->get_jobs($list['jobs_id']);
            $jobs[$key]['status'] = $list['status'];
            $jobs[$key]['apply_id'] = $list['id'];
            $jobs[$key]['direction'] = $list['direction'];
            $jobs[$key]['createtime'] = $list['createtime'];
            $jobs[$key]['offer'] = $list['offer'];
            if($list['status']==3){
                $jobs[$key]['interview'] = pdo_fetch("select * from ".tablename(WL.'interview')." where jobs_id=".$list['jobs_id']." and resume_id=".$list['resume_id']);
            }
            $company_profile = pdo_fetch("select * from ".tablename(WL."company_profile")." where uid=".$list['uid']);
            $jobs[$key]['tag'] = $company_profile['tag'];
            $jobs[$key]['retoate_x'] = $company_profile['retoate_x'];
            $jobs[$key]['retoate_y'] = $company_profile['retoate_y'];
            $jobs[$key]['city'] = $company_profile['city'];
        }
        return $jobs;
    }


    /*
     * 获取多行简历
     */
    public function getall_resume($uid=""){
        $resumes = pdo_fetchall("select * from ".tablename(WL.'resume'));
        $arr = "";
        foreach ($resumes as $resume){
            $edu_experience = unserialize($resume['edu_experience']);
            $education = "";
            $id = "";
            $edu = array('专科以下','专科','本科','硕士','博士','博士以上');
            $arr_edu = array_flip($edu);
            foreach ($edu_experience as $key=>$list){
                $value = $list['edu_district'];
                if(empty($education)){
                    $education = $arr_edu[$value];
                    $id = $key;
                }else{
                    if($arr_edu[$value]>$education){
                        $education = $arr_edu[$value];
                        $id = $key;
                    }
                }
            }
            $resume['education'] = $edu[$education];
            $resume['arr_education'] = $edu_experience[$id];
            $work_experience = unserialize($resume['work_experience']);

            $work_time = "";
            foreach ($work_experience as $list){
                $list['job_starttime'] = str_replace("月","",str_replace("年","-",$list['job_starttime']));
                $time = strtotime($list['job_starttime']);
                if(empty($work_time)){
                    $work_time = $time;
                }else{
                    if($time<$work_time){
                        $work_time = $time;
                    }
                }
            }
            $resume['work_time'] =  date('Y')-date('Y',$work_time);
            $arr[] = $resume;
        }
        return $arr;

    }
}