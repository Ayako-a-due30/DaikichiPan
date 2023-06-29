<?php require('./header.php'); ?>
<link href="./css/product-register.css" rel="stylesheet">
<?php 

  $pdo = new PDO('mysql:host=localhost;dbname=Daikichi;charset=utf8','root','root');
if(!empty($_REQUEST['product_name'])){
  $sql=$pdo->prepare('insert into product values(null,?,?,?,?)');
  $sql->execute([$_REQUEST['product_name'],$_REQUEST['product_img'],$_REQUEST['price'],$_REQUEST['quantity']]);
  $_REQUEST=array();
  echo <<<EOM
  <script type="text/javascript">
    alert( "商品を登録しました" )
  </script>
  EOM;
  header("Refresh:0");}

if(!empty($_REQUEST)){
  $sql = $pdo->prepare('update product set product_name=?,product_img=?, price=?,quantity=?');
  if($sql->execute(
    [htmlspecialchars($_REQUEST['product_name'],$_REQUEST['product_img'],$_REQUEST['price'],$_REQUEST['quantitty'])])
  );
}
 ?>
<main>
  <h1 class="link-button">販売商品登録</h1>
  <form action="" method="post" class="product-regist">
  <table class="register-table">
      <tr class="register-row"><th>商品名：</th><td><input type="text" name="product_name"></td></tr>
      <tr class="register-row"><th>商品写真：</th><td><input type="file" name="product_img"></td></tr>
      <tr class="register-row"><th>価格(円)：</th><td><input type="text" name="price"></td></tr>
      <tr class="register-row"><th>個数：</th><td><input type="text" name="quantity"></td></tr>
      <tr class="register-row"><th colspan="2"><input type="submit" value="登録"></td></tr>
    </table>
  </form>

  <h1 class="link-button">登録済み商品一覧</h1>
  <form action="" method="post"></form>
  <table class="product-table">
  <tr><th>ID</th><th>商品名</th><th>商品写真</th><th>価格</th><th>個数</th></tr>
  <?php
  $sql=$pdo->prepare('select*from product');
  foreach ($pdo->query('select*from product')as $row){
    echo '<tr><td class="product-data">'.$row['product_id'].'</td>';
    echo '<td class="product-data"><input type="text" value="'.$row['product_name'].'" name="product_name"></td>';
    echo '<td class="product-data"><img src="imgs/'.$row['product_img'].'" class="product-img"><input type="file" name="'.$row['product_id'].'.jpg"></td>';
    echo '<td class="product-data"><input type="text" value="'.$row['price'].'" name="price"></td>';
    echo '<td class="product-data"><input type="text" value="'.$row['quantity'].'" name="quantity"></td>';
    echo '<td class="product-data"><input type="submit" value="更新" style="vertical-align:middle;padding:0;margin:10px;width:100px;height:40px;font-size:20px;"> 
    <input type="submit" value="削除" style="vertical-align:middle;padding:0;margin:10px;width:100px;height:40px;font-size:20px">
    </td></tr>';
  }
  ?>
  </table>
</main>

<?php require('./footer.php'); ?>