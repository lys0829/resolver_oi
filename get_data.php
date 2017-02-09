<?php
require('config.php');
require_once('File.php');
$siteport = $_config['siteport'];
$sitedir = $_config['sitedir'];
$siteroot = '//'.$_SERVER['SERVER_NAME'].$sitedir;

$QUEST = '';
if (isset($_SERVER['PATH_INFO'])) {
    $QUEST = $_SERVER['PATH_INFO'];
}
if (!empty($QUEST)) { //remove first '/'
    $QUEST = substr($QUEST, 1);
}
$QUEST = explode('/', $QUEST);

if(empty($QUEST[0])){
    if(!isset($_POST['change'])){
        exit ('please add class name!!!');
    }
    else{
        $classn = json_decode($_POST['change'])->class_name;
    }
}
else{
    $classn = (string)$QUEST[0];
    
}
if(empty($QUEST[1])){
    if(!isset($_POST['change'])){
        exit ('please add contest name!!!');
    }
    else{
        $contestn = json_decode($_POST['change'])->contest_name;
    }
}
else{
    $contestn = (string)$QUEST[1];
}

if(!empty($QUEST[2])){
	$mod = $QUEST[2];
	if($mod == 'admin'){
		if(empty($QUEST[3])){
			exit ('no password');
		}
		else if($QUEST[3]!=$_config['admin_password']){
			exit ('wrong password');
		}
	}
}
else{
	$mod = 'live';
}
if(!is_dir($classn))exit ('no class');
if(!is_dir($classn.'/'.$contestn))exit ('no contest');

$dir = $classn.'/'.$contestn.'/';
$contest = json_decode(file_read($dir.'contest.json'));
$user_list = json_decode(file_read($dir.'userlist.json'));
$_config['class'] = $classn;
$_config['contest'] = $contestn;
$_config['start_time'] = $contest->start_time;
$_config['end_time'] = $contest->end_time;
$_config['freeze_time'] = $contest->freeze_time;
