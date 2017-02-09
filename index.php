<?php
require('get_data.php');
?>
<head>
<script src="<?=$siteroot?>jquery.min.js"></script>
</head>
<link href="<?=$siteroot?>bootstrap.min.css" rel="stylesheet">
<link href="<?=$siteroot?>resolver.css" rel="stylesheet">


<div id="scoreboard" class="scoreboard">
    <div id="table-head" class="scoreboard-head scoreboard-row">
        <div class="cell scoreboard-rank">#</div>
        <div class="cell scoreboard-name">TEAM</div>
        <div class="cell scoreboard-score" colspan="2">SCORE</div>
        <div class="scoreboard-problem-list"></div>
    </div>
    <div id="scoreboard-body">
    </div>
    <div id="scoreboard-foot" class="scoreboard-foot scoreboard-row">
        <div class="cell text-center" style="padding: 5px 30px;">
            <div class="pull-left">
                <?=$classn?> <?=$contestn?>
            </div>
            <div class="pull-right">
                <span class="label label-example"><b>Attempts</b> (Points)</span>
                <span class="label label-first">First Solver</span>
                <span class="label label-solved">Solved</span>
                <span class="label label-tried">Attempted</span>
                <span class="label label-pending">Pending</span>
            </div>
        </div>
    </div>
</div>

<div id="notrunning" class="col-md-8 col-md-offset-2" style="display: none;">
    <div class="text-center">
        <h1 style="color: white;">CONTEST IS NOT RUNNING</h1>
    </div>
</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
result_version = 0;
scoreboardUpdateTime = <?=$_config['scoreboard_update_time']?>;
g_before_url = "<?=$siteroot.$classn.'/'.$contestn.'/'?>resolver_before.json?<?=time()?>";
<?php if($mod=='admin'){ ?>
g_before_url = "<?=$siteroot.$classn.'/'.$contestn.'/'?>resolver_final.json?<?=time()?>";
<?php } ?>
g_final_url =  "<?=$siteroot.$classn.'/'.$contestn.'/'?>resolver_final.json?<?=time()?>";
</script>
<script src="<?=$siteroot?>handlebars.min.js"></script>
<?php if($mod=='resolver' && time()>$_config['end_time']){ ?>
<script src="<?=$siteroot?>resolver.js"></script>
<?php } else {?>
<script src="<?=$siteroot?>live.js"></script>
<?php } ?>