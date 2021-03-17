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
  <form action="" method="post" id="tournamentForm" name="tournamentForm" target="_self">
    Tournament name: <input type="text" id="tName" name="tName" value="Tournament name"><br>
    Organizer: <input type="text" id="tOrg" name="tOrg" value="Tournament organizer"><br><br>
    <label for="myCheck">Adjust Tournament Points:</label>
    <input type="checkbox" id="myCheck" onclick="myFunction()"><br>
    <div id="divPoints">
    Points per Win: <input type="text" id="tPtsW" name="tPtsW" value=""> Default: 3<br>
    Points per Draw: <input type="text" id="tPtsD" name="tPtsD" value=""> Default: 1<br>
    Points per Loss: <input type="text" id="tPtsL" name="tPtsL" value=""> Default: 0<br>
    </div>
    <br />
    <input type="submit" id="submit" name="submit" value="Submit">
    </form>
    <br />
    <?php
    $query = $result = "";
    if(isset($_POST["submit"])) {
      $t_name = $_POST["tName"];
      $t_org = $_POST["tOrg"];
      $t_pts_w = $_POST["tPtsW"];
      $t_pts_d = $_POST["tPtsD"];
      $t_pts_l = $_POST["tPtsL"];
      $query = "INSERT INTO tournaments (t_name, t_org, t_pts_w, t_pts_d, t_pts_l) VALUES ('$t_name', '$t_org', '$t_pts_w', '$t_pts_d', '$t_pts_l')";
      $result = $link->query($query);

      if ($result === TRUE) {
         echo "<span class='success'><br>======================<br><b>Tournament added succesfully!<br>======================</span></b><br>";
      } else {
          echo "<span class='error'><br><b>Error:</b><br>======================<br></span> $query <br> $link->error<br><span class='error'>======================</span>";
        }
    }
    ?>
  </div>
<?php mysqli_close($link); ?>
</body>
</html>
