<?php session_start(); ?>

<?php require('./header.php'); ?>
<link href="./css/reserve.css" rel="stylesheet">
<?php 


//
  //カート出力
$product_id=$_REQUEST['product_id'];

if(!isset($_SESSION['product'])){
  $_SESSION['product']=[];
}
$count=0;
if(isset($_SESSION['product'][$product_id])){
  $count=$_SESSION['product'][$product_id]['count'];
}

$_SESSION['product'][$product_id]=[
  'product_id'=>$product_id,
  'product_name'=>$_REQUEST['product_name'],
  'product_img'=>$_REQUEST['product_img'],
  'price'=>$_REQUEST['price'],
  'count'=>$count+$_REQUEST['count']
];
  echo '$_REQUEST<br>';
  var_dump($_REQUEST);
  echo '<br>$_SESSION<br>';
  var_dump($_SESSION);
  echo '<br>$_POST<br>';
  var_dump($_POST);

    echo <<<EOM
    <script type="text/javascript">
      alert( "カートに商品を追加しました" )
    </script>
    EOM;

if(!empty($_SESSION['product'])){
  echo '<h2>カートを見る</h2>';
  echo '<table><tr><th>商品番号</th><th>商品名</th><th>画像</th><th>価格</th><th>個数</th>
  <th>小計</th><th></th></tr>';
  $total=0;

  foreach($_SESSION['product']as $product_id=>$cart_row){
  $subtotal=$cart_row['price']*$cart_row['count'];
  $total+=$subtotal;
  echo '<form action="confirm.php">
  <tr><td><input type="hidden" name=product_id value="'.$cart_row['product_id'].'">
  '.$cart_row['product_id'].'</td>
  <td><input type="hidden" name=product_name value="'.$cart_row['product_name'].'">
  '.$cart_row['product_name'].'</td>
  <td><img src="./imgs/'.$cart_row['product_img'].'" alt="" class="product-img"></td>
  <td><input type="hidden" name=price value="'.$cart_row['price'].'">
  '.$cart_row['price'].'</td>
  <td><input type="hidden" name=count value="'.$cart_row['count'].'">'.$cart_row['count'].'</td>
  <td>'.$subtotal.'</td>
  <td><a href="delete.php?product_id='.$cart_row['product_id'].'">削除</a></td></tr>';
  }
  echo '<tr><td></td><td></td><td></td><td></td><td>合計</td>
  <td><input type="hidden" name=total value="'.$total.'">'.$total.'</td></tr>';
  echo '</table>';
  echo '<div><a href="reserve.php">商品を追加する</a></div>';
  echo '<div>受け取り希望日時<input type="datetime-local"></div>';
  echo '<input type="submit" value="注文を確定する"></form>';
}else{
  echo 'カートに商品がありません。';
}

?>





