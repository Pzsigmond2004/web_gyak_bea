<?php
include('./includes/config.inc.php');

$oldal = '';

if (!empty($_GET)) {
    $keys = array_keys($_GET);
    $oldal = $keys[0];
}

if ($oldal != "") {
    if (isset($oldalak[$oldal]) && file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
        $keres = $oldalak[$oldal];
    } else { 
        $keres = $hiba_oldal;
        header("HTTP/1.0 404 Not Found");
    }
} else {
    $keres = $oldalak['/'];
}

include('./templates/index.tpl.php');
?>
