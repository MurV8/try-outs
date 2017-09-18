<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
</head>

<style>

</style>


<body>

<p class="thx">Bedankt <?php echo $_POST["store"]; ?></p>

<?php
$store = $_POST["store"];

file_put_contents("$store.txt", $_POST);

 ?>

</body>

</html>
