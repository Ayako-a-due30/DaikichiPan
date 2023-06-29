<?php require('./header.php'); ?>
<link href="./css/product-register.css" rel="stylesheet">
<?php 
$pdo = new PDO('mysql:host=localhost;dbname=Daikichi;charset=utf8','root','root');
function h($string){
  return htmlspecialchars($string);
}
if(isset($_REQUEST['command'])){

  switch ($_REQUEST['command']){
    case 'update':
      if(empty($_REQUEST['product_name'])||!preg_match('/^[0-9]+$/',$_REQUEST['price']))break;
      if(isset($_REQUEST['product_img'])){
        $sql = $pdo->prepare('update product set product_name=?,product_img=?, price=?,quantity=? where product_id=?');
        $sql->execute([($_REQUEST['product_name']),$_REQUEST['product_img'],$_REQUEST['price'],
        $_REQUEST['quantity'],$_REQUEST['product_id']]);
        echo <<<EOM
        <script type="text/javascript">
          alert( "商品を更新しました" )
        </script>
        EOM;
      }else{
        $sql = $pdo->prepare('update product set product_name=?,price=?,quantity=? where product_id=?');
        $sql->execute([($_REQUEST['product_name']),$_REQUEST['price'],$_REQUEST['quantity'],$_REQUEST['product_id']]);
        echo <<<EOM
        <script type="text/javascript">
          alert( "商品を更新しました" )
        </script>
        EOM;
      }
      break;
    case 'delete':
      $sql=$pdo->prepare('delete from product where product_id=?');
      $sql->execute([$product_id]);
      break;
  }
}
?>
<h1 class="link-button">登録済み商品一覧</h1>

<table class="product-table">

<tr><th>ID</th><th>商品名</th><th>商品写真</th><th>価格</th><th>個数</th><th></th></tr>
<?php
$sql=$pdo->prepare('select*from product');
foreach ($pdo->query('select*from product')as $row){
  echo '<form action="product-set.php" method="post">';
  echo '<tr><td class="product-data">'.$row['product_id'].'</td>';
  echo '<td class="product-data"><input type="text" value="'.$row['product_name'].'" name="product_name"></td>';
  echo '<td class="product-data"><img src="imgs/'.$row['product_img'].'" class="product-img">
        <input type="file" name="product_img" value="'.$row['product_img'].'.jpg"></td>';
  echo '<td class="product-data"><input type="text" value="'.$row['price'].'" name="price"></td>';
  echo '<td class="product-data"><input type="text" value="'.$row['quantity'].'" name="quantity"></td>';
  echo '<td class="product-data">';
  echo '<input type="hidden" name="command" value="update">';
  echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
  echo '<input type="submit" value="更新" name="update" style="vertical-align:middle;padding:0;margin:10px;width:100px;height:40px;font-size:20px;">'; 
  echo '</form>';
  echo '<form action="product-set.php" method="post">';
  echo '<input type="hidden" name="command" value="delete">';
  echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
  echo '<input type="submit" value="削除" name="delete" style="vertical-align:middle;padding:0;margin:10px;width:100px;height:40px;font-size:20px"></td></tr>';
  echo '</form>';

}
?>

</table>
</main>

<?php require('./footer.php'); ?>