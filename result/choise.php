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

// This function will run within each post array including multi-dimensional arrays
function ExtendedAddslash(&$params)
{
        foreach ($params as &$var) {
            // check if $var is an array. If yes, it will start another ExtendedAddslash() function to loop to each key inside.
            is_array($var) ? ExtendedAddslash($var) : $var=addslashes($var);
        }
}

     // Initialize ExtendedAddslash() function for every $_POST variable
    ExtendedAddslash($_POST);

//Bovenstaande 'function' gekopieerd ivm sql-injection beveiliging.

$Winkel= $_POST['store'];
$Telefoon_1 = $_POST['telefoon'];
$Telefoon_2 = $_POST['telefoon2'];
$Telefooncentrale = $_POST['telefooncentrale'];
$Stickerprinter = $_POST['stickerprinter'];
$Scanner = $_POST['scanner'];

$db_host = 'localhost';
$db_username = '';
$db_password = '';
$db_name = 'apparaten';

mysql_connect("$db_host", "$db_username", "$db_password") or die("Oops");
mysql_select_db("$db_name");

$query = "SELECT * FROM 'apparaten' WHERE 'Winkel' = '$Winkel'";
$sqlsearch = mysql_query($query);
$resultcount = mysql_numrows($sqlsearch);

if ($resultcount > 0) {

    mysql_query("UPDATE apparaten SET
                                Winkel = '$Winkel',
                                Telefoon_1 = '$Telefoon_1',
                                Telefoon_2 = '$Telefoon_2',
                                Telefooncentrale = '$Telefooncentrale',
                                Stickerprinter = '$Stickerprinter',
                                Scanner = '$Scanner',
                             WHERE Winkel = '$Winkel'")
     or die(mysql_error());

} else {

    mysql_query("INSERT INTO apparaten (Winkel, Telefoon_1, Telefoon_2, Telefooncentrale, Stickerprinter, Scanner)
                               VALUES ('$Winkel', '$Telefoon_1', '$Telefoon_2', '$Telefooncentrale', '$Stickerprinter', '$Scanner'') ")
    or die(mysql_error());
}
mysql_close();
 ?>
<p>
  Bedankt <?php echo $Winkel ?>

</body>

</html>
