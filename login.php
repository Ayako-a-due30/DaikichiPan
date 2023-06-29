<?php session_start(); ?>

<?php require('./header.php') ?>
<link href="./css/login.css" rel="stylesheet">

<?php 
?>
<main>
  <h1 class="link-button">会員様ログイン</h1>
  <form action="./reserve.php" method="post">
    <table class="login">
      <tr>
        <th>メールアドレス</th>
        <td><input type="mail" name="mail"></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="password"></td>
      </tr>
      <tr class="submit-button">
        <td colspan="2">
          <input type="submit" value="ログイン">
        </td>
      </tr>

    </table>
  </form>
  <h1 class="link-button">会員様新規登録</h1>
  <form action="./reserve.php" method="post">
    <table class="admin">
      <tr>
        <th>お名前</th>
        <td>
          <input type="text" name="name">
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><input type="mail" name="mail"></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td><input type="tel" name="tel"></td>
      </tr>
      <tr>
        <td colspan="2" class="submit-button">
          <input type="hidden" name="command" value="register">
          <input type="submit" value="登録">
        </td>
      </tr>
    </table>
  </form>
</main>
<?php require('./footer.php') ?>