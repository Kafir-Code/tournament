<!DOCTYPE html>
<head>
</head>
<body>
  <div id="nDiv">
  <form action="" method="post" id="myForm" name="myForm" target="_self">
    <script type='text/javascript'>
    var member_number = 0;
    var group_number = 0;

    for (i=0;i<8;i++){
        var input = document.createElement("input");
        input.type = "text";
        input.name = "member" + member_number;
        //input.name = "member["+group_number+"][]";
        input.id = "member" + member_number;
        input.placeholder = "insert player name";
        myForm.appendChild(input);
        myForm.appendChild(document.createElement("br"));
        member_number++;
    }
    </script>
    <br />
    <input type="submit" id="submit" name="submit" value="Submit">
    </form>
    <br />
    <?php
    $x = 0;
    //$y = "<script>document.write(member_number);</script>";
      if(isset($_POST["submit"])) {
        while($x <= 64 && isset($_POST["member".$x])){
        //while($x <= 10 && "member".$x !== null){
          $muuttuja = "member" . $x;
          $php_var = $_POST[$muuttuja];
          echo "Tämä on PHP-muuttuja sisältö: " . $php_var;
          echo "<br />";
          echo "Kentän tunniste: " . $muuttuja;
          echo "<br /><br />";
          $x++;
        }
     }
    ?>
</div>
</body>
</html>
