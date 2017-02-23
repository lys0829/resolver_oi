<?php
/**$_POST['change'] struct
 *$info->vpl_uid
 *$info->vpl_id
 *$info->change_score
 *$info->class_name
 *$info->contest_name
 **/
require('output_to_resolver.php');
require('get_data.php');

$problem_list = $contest->problem;

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
		foreach($pro->vpl_id as $pro_pid){
			if($pro_pid == $info->vpl_id){
				$info->pid = $rpid;
				break;
			}
		}
        if($info->pid!=-1)break;
        $rpid++;
    }
    if($info->pid==-1)exit('no problem');
    
    $sublist = [];
    $sublist = json_decode(file_read($dir.'submission_list.json'));
    $sid = 0;
	$sublists = count($sublist);
    if($sublists>0)$sid = $sublist[$sublists-1]->id+1;
    //$info = json_decode($_POST['change']);
    $sublist_add = new stdclass();
    $sublist_add->id = $sid;
    $sublist_add->time_update = time();
    $sublist_add->uid = $info->uid;
    $sublist_add->pid = $info->pid;
    $sublist_add->score = $info->change_score;
    $sublist[count($sublist)] = $sublist_add;
    file_create($dir.'submission_list.json',json_encode($sublist));
	
	$f = calculate_result(
		$_config['class'],
		$_config['contest'],
		$_config['start_time'],
		$_config['end_time']);
		
	file_create($dir.'resolver_final.json',json_encode($f));
	if($sublist_add->time_update < $_config['freeze_time']){
		file_create($dir.'resolver_before.json',json_encode($f));
	}
    exit('SUCC');
}
