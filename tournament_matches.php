<!DOCTYPE html>
<html>
<head>
<style>
  #divPoints {
    margin-left: 20px;
    margin-top: 20px;
    display: none;
  }
</style>
  <script type='text/javascript'>
  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
      divPoints.style.display = "block";
    } else {
      divPoints.style.display = "none";
    }
  }
  </script>
</head>
<body>
  <?php  $link = mysqli_connect("127.0.0.1", "root", "", "turnaus");?>
<div id="nDiv">
  <h2>MATCH RESULTS</h2>
  Match result page where one can insert right results.

  <?php
    $t_id = $_GET['id'];
    $group_letter = 'A';
    $groups_number = 0;
    $sql = "SELECT t_groups FROM tournaments WHERE t_ID ='$t_id'";
    $result = $link->query($sql);
    $groupsit = $result->fetch_assoc();
    $groupsit = implode($groupsit);
    if($groupsit == 0){
      echo "<div>";
      echo "<br />";
      echo "<b><h3>Tournament information not set !!</h3><b>";
      echo "<br />";
      echo "</div>";
    }
    for($i = 1; $i <= $groupsit; $i++){

    echo "<div>";
    echo "<h2>Matches of Group ".$group_letter."</h2>";

    $m_sql = "SELECT * FROM matches WHERE m_tournament = $t_id ORDER BY m_round, m_group";
    $m_tulokset = $link->query($m_sql);
    $p_sql = "SELECT * FROM players WHERE p_tournament = $t_id ORDER BY p_group";
    $p_tulokset = $link->query($m_sql);
    if ($m_tulokset->num_rows > 0){
  ?>
<table cellspacing='4' cellpadding='0'>
  <tr>
  <th align='left' width='40'>ID</th>
  <th align='center' width='60'>Round</th>
  <th align='left' width='140'>Player Home</th>
  <th align='left' width='140'>Player Away</th>
  <th align='left' width='100'>Result</th>
  </tr>
  <?php
    while($rivi = $m_tulokset->fetch_assoc()) {
      $round_br = 1;
      $mid = $rivi['m_id'];
      $mtournament = $rivi['m_tournament'];
      $mgroup = $rivi['m_group'];
      $mround = $rivi['m_round'];
      $mhome = $rivi['m_home'];
      $maway = $rivi['m_away'];
      $mresult = $rivi['m_result'];
      if($mgroup == $group_letter){
      echo "<tr><td><a href='onedb_working.php?id=" . $mid . "'>" . $mid . "</td><td align=center>" . $mround . "</td><td>" . $mhome . "</td><td>" . $maway . "</td><td>" . "0-0" . $mresult . "</td></tr>";
      }
    }
    } else {
        echo "No matches available";
      }
  ?>
</table>
  <?php
    $group_letter++;
    echo "</div>";
    }
  ?>
</div>
  <?php mysqli_close($link); ?>
</body>
</html>
