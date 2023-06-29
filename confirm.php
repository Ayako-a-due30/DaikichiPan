<?php
session_start(); 
require('./header.php');


var_dump($_REQUEST);
$pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8','staff','password');
foreach($_SESSION[])
$sql=$pdo->prepare('insert into purchase values(null,?,?,?,?,?,?)');
$sql->execute([
  $_SESSION['customer']['customer_id'],
  $_SESSION['product']['product_id'],
  $_SESSION['product']['count'],
  $_REQUEST['total'],
  date()
  ])
?>