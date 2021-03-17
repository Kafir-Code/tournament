<!DOCTYPE html>
<head>
  <style>
  /*
  * {
     margin: 0px;
     padding: 0px;
     width: 100%;
     overflow: hidden;
}
*/
.success {
  color: #006400;
}

.error {
  color: #FF0000;
}

.db {
  color: #696969;
  font-size: 8px;
}

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
}

.newDivs {
     width: 300px;
     min-height: 200px;
     float: left;
     margin: 0 0 4px 4px;
     background-color: Gainsboro;
     border: 1px;
     border-style: solid;
     border-color: red;
     padding: 0 0 4px 4px;
}

#divAddGroup {
  height: 16px;
  margin-top: 2px;
  margin-bottom: 12px;
}
  </style>
  <script type='text/javascript'>
      var group_number = 0;
      var member_number = 1;
      var group_letter = "@";

      function nextChar(c) {
      return String.fromCharCode(c.charCodeAt(0) + 1);
      }

      function addGroup(){
        var a = document.getElementById("divAddGroup");

        var ID = document.createElement("input");
        ID.setAttribute("type", "text");
        ID.setAttribute("name", "member");
        ID.setAttribute("id", "member");
        ID.setAttribute("placeholder", "Number of players");

        a.appendChild(ID);

        var btn = document.createElement("BUTTON");
        btn.innerHTML = "Add players";
        btn.setAttribute("id", "BUTTON");
        a.appendChild(btn);
        document.getElementById("BUTTON").onclick = addFields;group_number++;
      }

      function addFields(){
          // Number of inputs to create
          var number = document.getElementById("member").value;
          var divcontainer = document.getElementById("divGroup" + group_number);
          var divAddGroupRemove = document.getElementById("divAddGroup");
          // Clear previous contents of the container
          while (divAddGroupRemove.hasChildNodes()) {
              divAddGroupRemove.removeChild(divAddGroupRemove.lastChild);
          }

          var nDiv = document.createElement("div")
          nDiv.name = "newDiv" + group_number;
          nDiv.id = "newDiv" + group_number;
          nDiv.setAttribute("class", "newDivs");

          divcontainer.appendChild(nDiv);
          var h1 = document.createElement("H1");
          var h1text = document.createTextNode("GROUP - " + nextChar(group_letter));
          group_letter = nextChar(group_letter);
          h1.appendChild(h1text);
          - - -
          nDiv.appendChild(h1);

          var groupID = group_number;
          console.log("Groups: " + groupID);

          var hiddenGroup = document.createElement("input");
          hiddenGroup.setAttribute("type", "hidden");
          hiddenGroup.setAttribute("name", "hiddenGroupID");
          hiddenGroup.setAttribute("id", "hiddenGroupID");
          hiddenGroup.setAttribute("value", group_letter);

          var hidGroupNum = document.createElement("input");
          hidGroupNum.setAttribute("type", "hidden");
          hidGroupNum.setAttribute("name", "hidGroupNum");
          hidGroupNum.setAttribute("id", "hidGroupNum");
          hidGroupNum.setAttribute("value", groupID);
          - - -
          nDiv.appendChild(hiddenGroup);
          nDiv.appendChild(hidGroupNum);

          for (i=1;i<=number;i++){
              nDiv.appendChild(document.createTextNode("Player  " + (i) + " "));

              var input = document.createElement("input");
              input.type = "text";
              input.name = "member" + member_number;
              input.id = "member" + member_number;
              input.placeholder = "insert player name";

              var hiddenInput = document.createElement("input");
              hiddenInput.setAttribute("type", "hidden");
              hiddenInput.setAttribute("name", "hiddenGroupLetter" + member_number);
              hiddenInput.setAttribute("id", "hiddenGroupLetter" + member_number);
              hiddenInput.setAttribute("value", group_letter);

              member_number++;
              - - -
              nDiv.appendChild(input);
              nDiv.appendChild(hiddenInput);
              nDiv.appendChild(document.createElement("br"));
          }
          console.log("Players (max): " + (member_number-1));

      }
  </script>
</head>
<body>
  <?php $link = mysqli_connect("127.0.0.1", "root", "", "turnaus");
  if (!$link) {
      echo "<span class='error'>Error: Unable to connect to MySQL.</span>" . PHP_EOL;
      echo "<span class='error'>Debugging errno: </span>" . mysqli_connect_errno() . PHP_EOL;
      echo "<span class='error'>Debugging error: </span>" . mysqli_connect_error() . PHP_EOL;
      exit;
  }
  echo "<span class='db'>db status: ok</span><br>" . PHP_EOL;

  $t_id = $_GET['id'];
  //echo "Tournament ID = ".$t_id;
  ?>
  <div id=topDiv>
    <button onClick="addGroup()">
      Add Group
    </button>
  </div>
  <div id=divAddGroup></div>
  <div class="container">
    <form action="" method="post" id="myForm" name="myForm" target="_self">
    <div id=divGroup1></div>
    <div id=divGroup2></div>
    <div id=divGroup3></div>
    <div id=divGroup4></div>
    <div id=divGroup5></div>
    <div id=divGroup6></div>
    <div id=divGroup7></div>
    <div id=divGroup8></div>
    <div id=divGroup9></div>
    <div id=divGroup10></div>
    <div id=divGroup11></div>
    <div id=divGroup12></div>
    <div id=divGroup13></div>
    <div id=divGroup14></div>
    <div id=divGroup15></div>
    <div id=divGroup16></div>
    <input type="submit" id="submit" name="submit" value="Submit">
    </form>
    <?php
     $query = $result = "";
     $x = 1;
     if(isset($_POST["submit"])) {
       $hidGroupNum = $_REQUEST["hidGroupNum"];
       $sql = "UPDATE tournaments SET t_groups = '$hidGroupNum' WHERE t_ID = $t_id";
       $sql_result = $link->query($sql);
        while($x <= 64 && isset($_POST["member".$x])) {
          $groupID = $_REQUEST["hiddenGroupLetter".$x];
          $muuttuja = "member" . $x;
          $playerName = $_POST[$muuttuja];
          $query = "INSERT INTO players (p_name, p_group, p_tournament) VALUES ('$playerName', '$groupID', '$t_id')";
          $result = $link->query($query);
          $x++;
        }
        if ($result === TRUE) {
           echo "<span class='success'><br>======================<br><b>".$hidGroupNum." groups and ".($x-1)." players added succesfully!<br>======================</span></b><br>";
         } else {
            echo "<span class='error'><br><b>Error:</b><br>======================<br></span> $query <br> $link->error<br><span class='error'>======================</span>";
          }
      }
    ?>
  </div>
  <?php mysqli_close($link); ?>
</body>
</html>
