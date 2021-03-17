<!DOCTYPE html>
<html>
<head>
<title>JavaScript muuttuja -> PHP muuttujaksi</title>
</head>
<body>
  <div id="nDiv">
  <form action="" method="post" target="_self">
    Name: <input type="text" id="fname" name="fname" placeholder="Insert Name ">
    <input type="submit" id="submit" name="submit" value="Submit">
  </form>
<!--
<script type='text/javascript'>
document.getElementById( 'submit' ).addEventListener( 'click', function () {
  var js_var = "Erkki Esimerkki";
  document.write("Tämä on JavaScript-muuttuja 'js_var':n sisältö: " + js_var);
} );
</script>
-->
<br />
<?php
if(isset($_POST["submit"])) {
/*  echo "
    <script type='text/javascript'>
    var js_var = document.getElementById('fname').value;
    document.write('Tämä on JavaScript-muuttuja js_var:n sisältö: ' + js_var);
    </script>
  ";
  echo "<br />";
  $php_var = "<script>document.write(js_var);</script>";
   echo "Tämä on PHP-muuttuja 'php_var':in sisältö: ", $php_var;
   */

  $php_var = $_POST["fname"];
   echo "Tämä on PHP-muuttuja sisältö: ", $php_var;
 }
?>
</body>
</html>
