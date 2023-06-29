<?php 
session_start();

require('./header.php'); 
?>
<link href="./css/logout.css" rel="stylesheet">
<?php

if(isset($_SESSION['customer'])){
  unset($_SESSION['customer']);
  echo '<div class="session-notice">ログアウトしました。</div>';
}else{
  echo '<div class="session-notice">すでにログアウトしています。</div>';
}



require('./footer.php'); ?>

