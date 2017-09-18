<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
</head>

<style>

p.thx {
  text-align: center;
  margin: 30px;
  background-color: lightgrey;
  border: 2px solid black;
  padding: 20px;
  font-size: 5em;
  font-weight: bold;
}

</style>


<body>

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

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'apparaten';

mysql_connect("$db_host", "$db_username", "$db_password") or die(mysql_error());
mysql_select_db("$db_name");

$Land = $_POST['Land'];
$Winkel= $_POST['store'];
$Telefoon_1 = $_POST['telefoon'];
$Telefoon_2 = $_POST['telefoon2'];
$Telefooncentrale = $_POST['telefooncentrale'];
$Stickerprinter = $_POST['stickerprinter'];
$Scanner = $_POST['scanner'];
$Get_Geupdate = mysql_query("SELECT Geupdate FROM apparaten WHERE Winkel = '$Winkel'");
$row = mysql_fetch_array($Get_Geupdate);
$Geupdate_Value = $row['Geupdate'];
$Counter = $Geupdate_Value;
$Counter_display = $Counter + 1;
$Geupdate = (++$Geupdate_Value);

$Winkel_array = array("Sliedrecht", "Hengelo", "Drachten", "Assen", "Capelle",
                  "Maassluis", "Eindhoven", "Deventer", "Oosterhout", "Uden",
                  "Zevenaar", "Mijdrecht", "Veenendaal", "Zaltbommel", "Hoogeveen",
                  "Nieuwegein", "Zoeterwoude", "Den Haag", "Groningen",
                  "Heerlen", "Alkmaar", "Amersfoort", "Wommelgem", "St. Joris-Winge",
                  "Roeselare", "Lochristi", "Genk", "Anderlues", "Herstal",
                  "Bochum", "Oberhausen", "Hannover", "Bremen", "Wurselen",
                  "Wiesbaden", "Dortmund", "Hanau", "Berlin", "Krefeld", "Furth",
                  "Hamburg-Halstenbek", "Munchen", "Waiblingen");

if (!in_array("$Winkel", $Winkel_array)) {
  echo "You messed with the file!";
  exit();
}

$Telefoon_array = array("E49", "R630", "S650", "");

if (!in_array("$Telefoon_1", $Telefoon_array)) {
  echo "You messed with the file!";
  exit();
}

if (!in_array("$Telefoon_2", $Telefoon_array)) {
  echo "You messed with the file!";
  exit();
}

$Telefooncentrale_array = array("SX205", "C3000", "SX353", "DX600", "Other");

if (!in_array("$Telefooncentrale", $Telefooncentrale_array)) {
  echo "You messed with the file!";
  exit();
}

$Stickerprinter_array = array("B443", "BSV4", "BFV4");

if (!in_array("$Stickerprinter", $Stickerprinter_array)) {
  echo "You messed with the file!";
  exit();
}

$Scanner_array = array("F732", "F734", "X3");

if (!in_array("$Scanner", $Scanner_array)) {
  echo "You messed with the file!";
  exit();
}

$query = "SELECT * FROM apparaten WHERE Winkel = '$Winkel'";
$sqlsearch = mysql_query($query);
$resultcount = mysql_numrows($sqlsearch);


if ($resultcount > 0) {

    mysql_query("UPDATE apparaten SET
                                Land = '$Land',
                                Winkel = '$Winkel',
                                Telefoon_1 = '$Telefoon_1',
                                Telefoon_2 = '$Telefoon_2',
                                Telefooncentrale = '$Telefooncentrale',
                                Stickerprinter = '$Stickerprinter',
                                Scanner = '$Scanner',
                                Geupdate = '$Geupdate'
                             WHERE Winkel = '$Winkel'")
     or die(mysql_error());

} else {

    mysql_query("INSERT INTO apparaten (Land, Winkel, Telefoon_1, Telefoon_2,
                                  Telefooncentrale, Stickerprinter, Scanner)
                               VALUES ('$Land','$Winkel', '$Telefoon_1', '$Telefoon_2',
                                  '$Telefooncentrale', '$Stickerprinter', '$Scanner') ")
    or die(mysql_error());
}



  if ($_POST['Lang'] == "NL") {
    echo "<p class='thx'>"."Bedankt $Winkel!"."</p>";
} elseif ($_POST['Lang'] == "FR") {
    echo "<p class='thx'>"."Merci $Winkel!"."</p>";
} elseif ($_POST['Lang'] == "DE") {
    echo "<p class='thx'>"."Danke $Winkel!"."</p>";
}

 if (!is_numeric($Counter)) {
  exit();
}

  if ($Counter >= 0 and $Counter < 3 and $_POST['Lang'] == "NL") {
   echo "<p class='thx'>"."Je hebt dit bestand nu $Counter_display keer geupdate."."</p>";
 } elseif ($Counter >= 3 and $_POST['Lang'] == "NL"){
   echo "<p class='thx'>"."Is het zo moeilijk? Nu $Counter_display keer geupdate."."</p>";
 }

  if ($Counter >= 0 and $Counter < 3 and $_POST['Lang'] == "FR") {
   echo "<p class='thx'>"."Vous avez mis à jour le fichier $Counter_display fois maintenant."."</p>";
}  elseif ($Counter >= 3 and $_POST['Lang'] == "FR"){
   echo "<p class='thx'>"."Est-ce si difficile? Maintenant $Counter_display fois mis à jour."."</p>";
}

  if ($Counter >= 0 and $Counter < 3 and $_POST['Lang'] == "DE") {
   echo "<p class='thx'>"."Du hast diese Datei jetzt $Counter_display mal aktualisiert."."</p>";
}  elseif ($Counter >= 3 and $_POST['Lang'] == "DE"){
   echo "<p class='thx'>"."Ist es so schwierig? Jetzt $Counter_display mal aktualisiert."."</p>";
}

  ?>


</body>

</html>
