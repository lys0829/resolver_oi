<?php
/**$_POST['change'] struct
 *$info->vpl_uid
 *$info->vpl_id
 *$info->change_score
 *$info->class_name
 *$info->contest_name
 **/
require('get_data.php');
$dir = $classn.'/'.$contestn; 
$contest = json_decode(file_read($dir.'/contest.json'));
$problem_list = $contest->problem;
$user_list = json_decode(file_read($dir.'/userlist.json'));

if(isset($_POST['change'])){
    $info = json_decode($_POST['change']);
    foreach($user_list as $u){
        if($user_list[$u->id]->vpl_uid == $info->vpl_uid){
            $info->uid = $u->id;
            break;
        }
    }
    $rpid = 0;
    $info->pid = -1;
    foreach($problem_list as $pro){
        if($pro->vpl_id == $info->vpl_id){
            $info->pid = $rpid;
            break;
        }
        $rpid++;
    }
    if($info->pid==-1)exit('no problem');
    if($info->change_score>$user_list[$info->uid]->score[$info->pid]){
		$user_list[$info->uid]->score[$info->pid] = (int)$info->change_score;
	}
    
    $sublist = [];
    $sublist = json_decode(file_read($dir.'/submission_list.json'));
    $sid = 0;
    if(count($sublist)>0)$sid = sublist[count($sublist)-1]->id+1;
    //$info = json_decode($_POST['change']);
    $sublist_add = new stdclass();
    $sublist_add->id = $sid;
    $sublist_add->time_update = time();
    $sublist_add->uid = $info->uid;
    $sublist_add->pid = $info->pid;
    $sublist_add->score = $info->change_score;
    $sublist[count($sublist)] = $sublist_add;
    file_create($dir.'/submission_list.json',json_encode($sublist));
    //file_create($classn.'/userlist.json',json_encode($user_list_save));
    exit('SUCC');
}
