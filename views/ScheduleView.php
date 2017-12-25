<?php

class ScheduleView implements View{

    protected $title = "Schedule - CRyptonite Robotics";

    public function render(){
        ?>
        <!DOCTYPE html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">  
            <title><?= $this->title ?></title>
            <link rel="icon" href="/favicon.ico">
            <meta name="theme-color" content="#222222">
            <link rel="stylesheet" type="text/css" href="/SuperCSSLoader.php">
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
          </head>
          <body>
          <table class="scheduleTable">
		    <tr class="top">
                <th class="header"><b>Match</b></th>
                <th class="header-time"><b>Time</b></th>
                <th class="header"><b>Red 1</b></th>
                <th class="header"><b>Red 2</b></th>
                <th class="header"><b>Red 3</b></th>
                <th class="header"><b>Blue 1</b></th>
                <th class="header"><b>Blue 2</b></th>
                <th class="header"><b>Blue 3</b></th>
		    </tr>
            <?php
                $this->schedule = (new MatchScheduleDatabaseModel())->getAllMatches();
                $teams = array();
                foreach($this->schedule as $a){
                    array_push($teams,$a['red_1'],$a['red_2'],$a['red_3'],$a['blue_1'],$a['blue_2'],$a['blue_3']);
                    $match= a['match_number'];
            ?>
            <tr>
                <td><?php $a['matchNumber']?></td> <!--must have clickable link to match info display-->
                <?php
                    foreach($teams as $t){
                        $ifknown = (new MatchDataDatabaseModel())->dataCoverage($match, $team);
                        if($ifknown){
                            ?> <td>GREEN</td>
                        <?php}
                        else{
                            ?> <td>RED</td>
                       <?php }
                    }
                ?>    
            </tr>
                <?php } ?>
            </table>
          </body>
        </html>
        <?php
    }
    
    
}

?>