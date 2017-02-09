<?php
//$class_name = '2016101';
//$contest_name = 'exam';
require_once('File.php');
require('config.php');

function find_user($list,$id){
	$p = 0;
	foreach($list as $user){
		if($id==$user->id)return $p;
		$p++;
	}
	return -1;
}

function calculate_result($class_name,$contest_name,$start_time,$end_time){
	//=====define contest information=====//
	$dir = $class_name.'/'.$contest_name.'/';
	$contest = json_decode(file_read($dir.'contest.json'));
	$problems = $contest->problem;
	$users = json_decode(file_read($dir.'userlist.json'));
	$submissions = json_decode(file_read($dir.'submission_list.json'));
	
	//=====define $reesults=====//
	$results = new stdclass();
	$results->solved = new stdclass();
	$results->attempted = new stdclass();
	$results->problems = new stdclass();
	$results->scoreboard = [];
	$results->points = 0;
	
	$pid=0;
	foreach($problems as $problem){
		$pn = $problem->name;
		$results->solved->$pn = 0;
		$results->attempted->$pn = 0;
		$results->problems->$pn = new stdclass();
		$results->problems->$pn->score = $problem->grade;
		$results->problems->$pn->pid = $pid;
		$results->problems->$pn->maxscore = 0;
		$results->problems->$pn->first_user = -1;
		$pid++;
	}
	
	foreach($users as $user){
		$u = new stdclass();
		$u->id = $user->id;
		$u->rank = 1;
		$u->solved = 0;
		$u->points = 0;
		$u->name = $user->name;
		$u->group = "";
		$u->score = 0;
		$problem = (array)$results->problems;
		foreach($problem as $p => $var){
			$u->$p = new stdclass();
			$u->$p->a = 0;
			$u->$p->t = 0;
			$u->$p->s = "nottried";
			$u->$p->score = 0;
			$u->$p->color = '_0';
		}
		$results->scoreboard[] = $u;
	}
	
	//=====calculate results=====//
	foreach($submissions as $submission){
		if($submission->time_update>$end_time || $submission->time_update<$start_time){
			continue;
		}
		
		$pn = $problems[$submission->pid]->name;
		$uid = find_user($results->scoreboard,$submission->uid);
		$results->attempted->$pn++;
		$results->scoreboard[$uid]->$pn->a++;
		if($results->scoreboard[$uid]->$pn->s != "solved")$results->scoreboard[$uid]->$pn->s = "tried";
		if($submission->score){
			if($results->scoreboard[$uid]->$pn->s != "solved"){
				$results->solved->$pn++;
				$results->scoreboard[$uid]->solved++;
				$results->scoreboard[$uid]->$pn->s = "solved";
			}
			if($results->scoreboard[$uid]->$pn->score < $submission->score){
				$results->scoreboard[$uid]->score -= $results->scoreboard[$uid]->$pn->score;
				$results->scoreboard[$uid]->$pn->score = (int)$submission->score;
				$results->scoreboard[$uid]->score += $results->scoreboard[$uid]->$pn->score;
				$results->points-=$results->scoreboard[$uid]->$pn->t;
				$results->scoreboard[$uid]->$pn->t = (int)(($submission->time_update-$start_time)/60);
				$results->points+=$results->scoreboard[$uid]->$pn->t;
				
				if($results->scoreboard[$uid]->$pn->score > $results->problems->$pn->maxscore){
					$results->problems->$pn->maxscore = $results->scoreboard[$uid]->$pn->score;
					$results->problems->$pn->first_user = $uid;
				}
			}
		}
	}
	
	//=====set first=====//
	foreach($problems as $problem){
		$pn = $problem->name;
		if($results->problems->$pn->first_user != -1){
			$uid = $results->problems->$pn->first_user;
			$results->scoreboard[$uid]->$pn->s = 'first';
		}
	}
	return $results;
}

?>