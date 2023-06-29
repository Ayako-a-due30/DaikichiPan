<?php
session_start();
require('./header.php'); 

unset($_SESSION['product'][$_REQUEST['product_id']]);
echo 'カートから商品を削除しました。';
echo '<div><a href="cart.php">カートに戻る</a></div>';
echo '<hr>';


?>
