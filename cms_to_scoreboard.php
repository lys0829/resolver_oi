<?php
require("File.php");
require("config.php");

function find_user($list,$name){
	foreach($list as $u){
		if($u->user == $name){
			return $u->id;
		}
	}
	return -1;
}
function find_problem($list,$pname){
	$pid = 0;
	foreach($list as $p){
		if($p->name == $pname){
			return $pid;
		}
		$pid++;
	}
	return -1;
}

$name = $_config['class'];
$contest_name = $_config['contest'];
$dir = $name.'/'.$contest_name.'/';
$subchange_list = glob($dir.'subchanges/*.json');
$problem_list = glob($dir.'tasks/*.json');
$user_list = glob($dir.'users/*.json');
$contest = json_decode(file_read($dir.'contest.json'));
$contest->problem = [];
$submission_list = [];
$user_list_output = [];

$uid = 0;
foreach($user_list as $u){
	$user_list_output[$uid] = new stdclass();
	$user = "";
	$user = explode('.',$u);
	$user = reset($user);
	$user = explode('/',$user);
	$user = end($user);
	$user_list_output[$uid]->user = $user;
	//echo $user;
	$u = json_decode(file_read($u));
	$user_list_output[$uid]->name = $u->l_name;
	$user_list_output[$uid]->id = $uid;
	$uid++;
}
file_create($dir.'userlist.json',json_encode($user_list_output));

$pid = 0;
foreach($problem_list as $p){
	$p = json_decode(file_read($p));
	$contest->problem[$pid] = new stdclass();
	$contest->problem[$pid]->name = $p->short_name;
	$contest->problem[$pid]->grade = $p->max_score;
	$pid++;
}
//echo json_encode($contest);
file_create($dir.'contest.json',json_encode($contest));

$sid = 0;
foreach($subchange_list as $submission){
	$subchange = json_decode(file_read($submission));
	$submission_list[$sid] = new stdclass();
	$submission_list[$sid]->time_update = $subchange->time;
	$submission = json_decode(file_read($dir.'submissions/'.$subchange->submission.'.json'));
	$submission_list[$sid]->id = $sid;
	$submission_list[$sid]->uid = find_user($user_list_output,$submission->user);
	$submission_list[$sid]->pid = find_problem($contest->problem,$submission->task);
	$submission_list[$sid]->task = $submission->task;
	$submission_list[$sid]->score = (int)$subchange->score;
	$sid++;
}
file_create($dir.'submission_list.json',json_encode($submission_list));