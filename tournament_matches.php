<!DOCTYPE html>
<html>
<head>
<style>
  #divPoints {
    margin-left: 20px;
    margin-top: 20px;
    display: none;
  }
  input[type=text] {
    width: 25px;
    text-align: center;
  }
  table {
    background-color: #00001A;
    color: white;
    border-radius: 10px;
    padding: 2px;
  }
  table a {
    color: gray;
  }
  table th {
    color: darkorange;
  }
</style>
</head>
<body>
  <?php  $link = mysqli_connect("127.0.0.1", "root", "", "turnaus");?>
<div id="nDiv">
  <h2>MATCH RESULTS</h2>
  Match result page where one can update all match results.

  <?php
    $t_id = $_GET['id'];
    $group_letter = 'A';
    $groups_number = 0;
    $match_count = 0;
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
    if ($m_tulokset->num_rows > 0){
  ?>
<form action="" method="post" id="matchesForm" name="matchesForm" target="_self">
<table cellspacing='4' cellpadding='0'>
  <tr>
  <th align='left' width='40'>ID</th>
  <th align='center' width='60'>Round</th>
  <th align='left' width='140'>Player Home</th>
  <th align='left' width='140'>Player Away</th>
  <th align='center' width='40'>Home</th>
  <th align='center' width='20'></th>
  <th align='center' width='40'>Away</th>
  <th align='center' width='10'></th>
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
      $mghome = $rivi['m_g_home'];
      $mgaway = $rivi['m_g_away'];
      $mresult = $rivi['m_result'];
      $mht = $rivi['m_ht'];
      if($mgroup == $group_letter){
      echo "<tr><td><input type='hidden' id='hid_mid".$match_count."' name='hid_mid".$match_count."' value=".$mid.">"."<a href='onedb_working.php?id=".$mid."'>".$mid."</td><td align=center>".$mround."</td><td>".$mhome."</td><td>".$maway."</td><td align=center><input type='text' id='form_mgHome".$match_count."' name='form_mgHome".$match_count."' value=".$mghome.">"."</td><td align=center>".'-'."</td><td align=center><input type='text' id='form_mgAway".$match_count."' name='form_mgAway".$match_count."' value=".$mgaway.">"."</td><td align=center>".$mht."</td></tr>";
      $match_count++;
      }
    }
    } else {
        echo "No matches available";
      }
    $matches = $match_count;
  ?>
</table>
<br />
<input type="submit" id="submit" name="submit" value="Update group score(s)">
</form>
  <?php
    $group_letter++;
    echo "</div>";
    }
  ?>
</div>
  <?php
  if(isset($_POST["submit"])) {
    $x = 0;
    while($x <= $matches && isset($_POST["form_mgHome".$x])) {
      $form_mid = $_REQUEST["hid_mid".$x];
      $form_mghome = $_POST["form_mgHome".$x];
      $form_mgaway = $_POST["form_mgAway".$x];
      $m_update = "UPDATE matches SET m_g_home='$form_mghome', m_g_away='$form_mgaway' WHERE m_id=$form_mid";
      $result = $link->query($m_update);
      $x++;
    }
    echo "<meta http-equiv='refresh' content='0'>";
  }
  ?>
  <?php mysqli_close($link); ?>
</body>
</html>
