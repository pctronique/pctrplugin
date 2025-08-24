<?php
include __DIR__."/src/repository/Tabsgbd_repository.php";

$sgbd = new Tabsgbd_repository();
if(!empty($_GET) && !empty($_GET["id"])) {
    $id=$_GET["id"];
    $values=$sgbd->deleteId($_GET["id"]);
}

header("Location: ./");
