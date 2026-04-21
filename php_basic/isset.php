<?php
if (isset($_POST["name"])) {
  $name = $_POST["name"];
  echo $name;
}

var_dump(isset($_POST["name"]));
?>