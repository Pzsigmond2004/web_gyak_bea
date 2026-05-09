<?php
// Eredeti logika megtartása
$data = $_SESSION;

unset($_SESSION["csn"]);
unset($_SESSION["un"]);
unset($_SESSION["login"]);

//Session teljes lezárása (ajánlott kiegészítés)
session_destroy();

//Visszairányítás a főoldalra
header("Location: ./");
exit;
?>
