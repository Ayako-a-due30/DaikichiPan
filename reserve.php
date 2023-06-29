<?php session_start(); ?>

<?php require('./header.php'); ?>
<link href="./css/reserve.css" rel="stylesheet">
<?php 
//ログイン処理
unset($_SESSION['customer']);
$pdo = new PDO('mysql:host=localhost;dbname=Daikichi;charset=utf8','root','root');
if(empty($_REQUEST)){
  echo '<div class="session-notice">ご予約の方はログインしてください。<br><a href="./login.php" class="notice-link">ログイン画面へ</a>
  </div>';
  }elseif(!empty($_REQUEST['mail'] && $_REQUEST['password'])){
    $sql=$pdo->prepare('select*from customer where Email=? and password=?');
    if($sql->execute([$_REQUEST['mail'],$_REQUEST['password']])){
      foreach($sql as $row){
        $_SESSION['customer']=$row;
        echo '<div class="session-notice">こんにちは！'.$row['name'].'さん。<br>
        <a href="./logout.php" class="notice-link">ログアウトはこちら</a></div>';
      }
    }else{
        echo '<div class="session-notice">メールまたはパスワードが間違っています。</div>';
        header('./login.php');
    }
  }


  //商品一覧
  echo '<table><tr><th>商品番号</th><th>商品名</th><th>商品画像</th><th>価格</th><th>注文個数</th><th></th></tr>';
  foreach($pdo ->query('select*from product')as $row){
    echo '<form action="cart.php" method="post"><tr>
    <td><input type="hidden" name="product_id" value="'.$row['product_id'].'">'.$row['product_id'].'</td>
    <td><input type="hidden" name="product_name" value="'.$row['product_name'].'">'.$row['product_name'].'</td>
    <td><input type="hidden" name="product_img" value="'.$row['product_img'].'"><img src="./imgs/'.$row['product_img'].'" alt="" class="product-img"></td>
    <td><input type="hidden" name="price" value="'.$row['price'].'">'.$row['price'].'</td>
    <td><select name="count" id="">';
    for($i=0;$i<10;$i++){
      echo '<option value="'.$i.'" name="count">'.$i.'</option>';
    }
      echo '</select></td><td><input type="submit" value="予約"></td>
      </form></tr>';
    }
    echo '</table>';
  

?>
<?php require('./footer.php'); ?>


