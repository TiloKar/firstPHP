<?php
/* Muster für Aufbau einer SQL Verbindung dann query in Tabelle und JSON Ausgabe zum parsen im clientseitigen js
 to do: von jens lesenden user erbetteln auf die tabelle mit den kvasy Rechten und ungefähre schema-beschreibung
 wahrscheinlich für jeden mandanten eine abfrage...

*/
try{    
    $dsn = 'mysql:host=localhost:3307;dbname=tilo;charset=utf8mb4';
    $username = 'tilo';
    $port = 'tilo';
    $password = 'dblocal1815*#';
    $dbh = new \PDO($dsn, $username, $password);
    //echo("Verbindung da");
}catch (\Exception $e){
    die('Fehler Datenbankaufbau: ' + $e);
}
try{ 
    $zeilen = $dbh->query('SELECT * FROM `wp_av_options`');
}catch (\Exception $e){
    die('Fehler Abfrage: ' + $e);
} 
if ($zeilen){
    $zeilen = $zeilen->fetchAll();
    echo(json_encode($zeilen));
}else{
    echo("false");
}

/*
die datei ist dann ein JSON-array von objecten mit den spaltennamen als keys

nach dem holen der datei per xhr im js, nur noch per 
    const data=JSON.parse(response);
   
   Rückgabe  z.B. für options Tabelle von meiner lokalen Wordpress MySQL
[{"option_id":1,"0":1,"option_name":"siteurl","1":"siteurl","option_value":"http:\/\/localhost\/wp","2":"http:\/\/localhost\/wp","autoload":"yes","3":"yes"},
{"option_id":2,"0":2,"option_name":"home","1":"home","option_value":"http:\/\/localhost\/wp","2":"http:\/\/localhost\/wp","autoload":"yes","3":"yes"},
{"option_id":3,"0":3,"option_name":"blogname","1":"blogname","option_value":"WP Sandkasten lokal","2":"WP Sandkasten lokal","autoload":"yes","3":"yes"},...
*/
?>
