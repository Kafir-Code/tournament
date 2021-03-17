<?php
include_once 'src/round-robin.php';
$link = mysqli_connect("127.0.0.1", "root", "", "turnaus");
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    .container {
      overflow: hidden;
      width: 100%;
      white-space: nowrap;
      padding-left: 4px;
    }

    .container > div {
      width: 300px;
      min-height: 200px;
      float: left;
      margin: 2px 8px 0 0px;
      background-color: Gainsboro;
      border: 1px;
      border-style: solid;
      border-color: red;
      padding: 0 0 4px 4px;
    }
  </style>
  <title>Tournament Preview</title>
</head>
<body>
  <h1>Tournament Preview</h1>
  <p>
    This generates a schedule where each contestant meets each other once.<br>
    Create tournament and save match schedule by clicking the button below.
  </p>
<div class="container">
<form action="" method="post" id="myTournament" name="myTournament" target="_self">
  <input type="submit" id="submit" name="submit" value="Save Tournament">
</form>
<br />
  <?php
    $group_letter = 'A';
    $groups_number = 0;
    $t_id = $_GET['id'];
    $created_sql = "SELECT t_games_created FROM tournaments WHERE t_ID ='$t_id'";
    $created_games = $link->query($created_sql);
    while($row = $created_games->fetch_assoc()) {$created = $row['t_games_created'];}
    $sql = "SELECT t_groups FROM tournaments WHERE t_ID ='$t_id'";
    $result = $link->query($sql);
    $groupsit = $result->fetch_assoc();
    $groupsit = implode($groupsit);
      for($i = 1; $i <= $groupsit; $i++){
        $teams = array();
        $haku = "SELECT * FROM players WHERE p_tournament = '$t_id' AND p_group = '$group_letter' ORDER BY p_name ASC";
        $tulokset = $link->query($haku);

        echo "<div>";
        echo "<table cellspacing='5' cellpadding='0'>";
        echo "<tr>";
          echo "<th align='left' width='80'>Name</th>";
          echo "<th align='left' width='15'>G</th>";
          echo "<th align='left' width='15'>W</th>";
          echo "<th align='left' width='15'>D</th>";
          echo "<th align='left' width='15'>L</th>";
          echo "<th align='left' width='15'>F</th>";
          echo "<th align='left' width='15'>A</th>";
          echo "<th align='left' width='15'>+/-</th>";
          echo "<th align='left' width='15'>Pts</th>";
        echo "</tr>";

        while($rivi = $tulokset->fetch_assoc()) {
          $pname = $rivi['p_name'];
          $pgames = $rivi['p_games'];
          $pwins = $rivi['p_wins'];
          $pdraws = $rivi['p_draws'];
          $plosses = $rivi['p_losses'];
          $pfor = $rivi['p_g_for'];
          $pagainst = $rivi['p_g_against'];
          $pdiff = $rivi['p_g_difference'];
          $ppts = $rivi['p_points'];
          $pgroup = $rivi['p_group'];
          echo "<tr><td>".$pname."</td><td>".$pgames."</td><td>".$pwins."</td><td>".$pdraws."</td><td>".$plosses."</td><td>".$pfor."</td><td>".$pagainst."</td><td>".$pdiff."</td><td>".$ppts."</td></tr>";
          array_push($teams,$pname);
        }

        echo "</table>";
        echo "<h2>Matches of Group ".$group_letter."</h2>";

        $scheduleBuilder = new ScheduleBuilder($teams);
        $schedule = $scheduleBuilder->build();

        foreach($schedule as $round => $matchups){
        echo "<h3>Round ".$round."</h3>";
        echo "<ul>";
        foreach($matchups as $matchup) {
          echo "<li>".($matchup[0] ?? '*BYE*')." vs. ".($matchup[1] ?? '*BYE*')."</li>";

          if($matchup[0] != NULL){
            $m_home = $matchup[0];
          }
            else{
              $m_home = "*BYE*";
            }
          if($matchup[1] != NULL){
            $m_away = $matchup[1];
          }
            else{
              $m_away = "*BYE*";
            }

        if(isset($_POST["submit"]) && !$created) {
            $match_query = "INSERT INTO matches (m_tournament, m_group,  m_round, m_home, m_away) VALUES ('$t_id', '$pgroup', '$round', '$m_home', '$m_away')";
            $match_result = $link->query($match_query);
            $matches_set = "UPDATE tournaments SET t_games_created = TRUE WHERE t_ID = $t_id";
            $sql_matches_set = $link->query($matches_set);
          }
        }
        echo "</ul>";
        }
        $group_letter++;
      echo "</div>";
    }?>
</div>
</body>
</html>
