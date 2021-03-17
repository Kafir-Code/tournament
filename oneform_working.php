<!DOCTYPE html>
<head>
  <style>
  /*
  * {
     margin: 0px;
     padding: 0px;
     width: 100%;
     overflow: hidden;
*/
}
.container{
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
     /*margin-top: 4px*/
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
          //var h1text = document.createTextNode("GROUP " + group_number);
          var h1text = document.createTextNode("GROUP - " + nextChar(group_letter));
          group_letter = nextChar(group_letter);
          h1.appendChild(h1text);
          - - -
          nDiv.appendChild(h1);

          var groupID = group_number;
          console.log("Group " + group_number + " groupID: " + groupID);

          var hiddenGroup = document.createElement("input");
          hiddenGroup.setAttribute("type", "hidden");
          hiddenGroup.setAttribute("name", "hiddenGroupID");
          hiddenGroup.setAttribute("id", "hiddenGroupID");
          hiddenGroup.setAttribute("value", group_letter);
          - - -
          nDiv.appendChild(hiddenGroup);

          for (i=1;i<=number;i++){
              nDiv.appendChild(document.createTextNode("Player  " + (i) + " "));

              var input = document.createElement("input");
              input.type = "text";
              //input.name = "member["+group_number+"][]";
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
          console.log("Pelaajia (max): " + (member_number-1));

      }
  </script>
</head>
<body>
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
    <br />
    <input type="submit" id="submit" name="submit" value="Submit">
    </form>
    <?php
    $x = 1; // Tämä viittaa Groupin ensimmäiseen memberiin
      if(isset($_POST["submit"])) {
        while($x <= 64 && isset($_POST["member".$x])){
          $groupID = $_REQUEST["hiddenGroupLetter".$x];
//          $groupID = $_REQUEST["hiddenGroupID"];
          $muuttuja = "member" . $x;
          $php_var = $_POST[$muuttuja];
          echo "Ryhmän tunniste: " . $groupID;
//          foreach($groupID as $groupID)
//          {echo $groupID;}
          echo "<br />";
          echo "Pelaajan tunniste: " . $muuttuja;
          echo "<br />";
          echo "Pelaajan nimi: " . $php_var;
          echo "<br /><br />";
          $x++;
        }
     }
    ?>
  </div>
</body>
</html>
