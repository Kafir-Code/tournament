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
  <?php $link = mysqli_connect("127.0.0.1", "root", "", "turnaus");?>
  <div id="nDiv">
  <h2>Add Tournament</h1>
  <form action="" method="post" id="tournamentForm" name="tournamentForm" target="_self">
    Tournament name: <input type="text" id="tName" name="tName" placeholder="Tournament name"><br>
    Organizer: <input type="text" id="tOrg" name="tOrg" placeholder="Tournament organizer"><br>
    Date: <input type="text" id="tDate" name="tDate" placeholder="YYYY-MM-DD"><br><br>
    <label for="myCheck">Adjust Tournament Points:</label>
    <input type="checkbox" id="myCheck" onclick="myFunction()"><br>
    <div id="divPoints">
    Points per Win: <input type="text" id="tPtsW" name="tPtsW" value="3"><br>
    Points per Draw: <input type="text" id="tPtsD" name="tPtsD"  value="1"><br>
    Points per Loss: <input type="text" id="tPtsL" name="tPtsL"  value="0"><br>
    </div>
    <br />
    <input type="submit" id="submit" name="submit" value="Submit">
    </form>
    <?php
    $query = $result = "";
    if(isset($_POST["submit"])) {
      $t_name = $_POST["tName"];
      $t_org = $_POST["tOrg"];
      $t_date = $_POST["tDate"];
      $t_pts_w = $_POST["tPtsW"];
      $t_pts_d = $_POST["tPtsD"];
      $t_pts_l = $_POST["tPtsL"];
      $query = "INSERT INTO tournaments (t_name, t_org, t_date, t_pts_w, t_pts_d, t_pts_l) VALUES ('$t_name', '$t_org', '$t_date', '$t_pts_w', '$t_pts_d', '$t_pts_l')";
      $result = $link->query($query);

      if ($result === TRUE) {
         echo "<span class='success'><br>======================<br><b>Tournament added succesfully!<br>======================</span></b><br>";
      } else {
          echo "<span class='error'><br><b>Error:</b><br>======================<br></span> $query <br> $link->error<br><span class='error'>======================</span>";
        }
    }
    ?>
  </div>
  <br />
  <div>
    <h2>Tournaments - List</h2>
      <?php
      $sql = "SELECT * FROM tournaments ORDER BY t_date DESC";
      $tulokset = $link->query($sql);
      if ($tulokset->num_rows > 0) {
      ?>
        <table cellspacing='3' cellpadding='0'>
          <tr>
          <th align='left' width='40'>ID</th>
          <th align='left' width='160'>Tournament</th>
          <th align='left' width='120'>Organizer</th>
          <th align='left' width='120'>Date</th>
          <th align='left' width='40'>Groups</th>
          </tr>
      <?php
        while($rivi = $tulokset->fetch_assoc()) {
          $tid = $rivi['t_ID'];
          $tname = $rivi['t_name'];
          $torg = $rivi['t_org'];
          $tdate = $rivi['t_date'];
          $tgroups = $rivi['t_groups'];
          echo "<tr><td><a href='onedb_working.php?id=" . $tid . "'>" . $tid . "</td><td><a href='group_and_robin.php?id=" . $tid . "'>" . $tname . "</td><td><a href='tournament_matches.php?id=" . $tid . "'>" . $torg . "</td><td>" . $tdate . "</td><td align='center'>" . $tgroups . "</td></tr>";
        }
      } else {
         echo "No tournaments";
        }
      ?>
    </table>
  </div>
<?php mysqli_close($link); ?>
</body>
</html>
