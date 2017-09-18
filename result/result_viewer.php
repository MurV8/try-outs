<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/style/table.css">
<!--  <link rel="stylesheet" href="/style/button_style.css"> -->
  <link rel="stylesheet" href="/style/intranet_style.css">
</head>

<body>

  <?php

  $db_host = 'localhost';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'apparaten';

  mysql_connect("$db_host", "$db_username", "$db_password") or die(mysql_error());
  mysql_select_db("$db_name");

$result = mysql_query("SELECT * FROM apparaten ORDER BY FIELD(Land, 'NL', 'BE', 'DE'),
                                        Winkel ASC");

$resultcount = mysql_numrows($result);

?>

<p class="logo" id="logo"></p>
<div class="headerholder">
<p class="header" id="header">Seats and Sofas</p>
</div>
<p class="h2" id="h2">Aanwezige apparatuur:</p>

<div style="overflow-x:auto;">
<table class="result" <?php if ($resultcount == 0) {echo 'style="display:none;"';} ?>>
<thead>
  <tr>
    <th id="Land">Land</th>
    <th id="Winkel">Winkel</th>
    <th>Telefoon&nbsp;1</th>
    <th>Telefoon&nbsp;2</th>
    <th>Telefooncentrale</th>
    <th>Stickerprinter</th>
    <th>Scanner&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>Doorvoertijd</th>
    <th>Geupdate</th>
  </tr>
</thead>
<tbody>
  <?php

    if ($resultcount == 0) {
      echo "<p class='nothing'>"."Nog geen gegevens..."."</p>";
    } else {

    while( $row = mysql_fetch_assoc( $result ) ){
      echo
      "<tr>
        <td class=\"leftleft\">{$row['Land']}</td>
        <td class=\"left\">{$row['Winkel']}</td>
        <td id=\"{$row['Telefoon_1']}\">{$row['Telefoon_1']}</td>
        <td id=\"{$row['Telefoon_2']}\">{$row['Telefoon_2']}</td>
        <td id=\"{$row['Telefooncentrale']}\">{$row['Telefooncentrale']}</td>
        <td id=\"{$row['Stickerprinter']}\">{$row['Stickerprinter']}</td>
        <td id=\"{$row['Scanner']}\">{$row['Scanner']}</td>
        <td class=\"right\">{$row['Doorvoertijd']}</td>
        <td class=\"rightright\">{$row['Geupdate']}</td>
      </tr>";
    }
  }
  ?>
</tbody>
</table>
</div>

<?php mysql_close(); ?>

</body>
</html>
