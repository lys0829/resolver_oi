<?php
require('config.php');
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
if(!is_dir($classn))exit ('no class');
if(!is_dir($classn.'/'.$contestn))exit ('no contest');