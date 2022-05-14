<?php require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Комментарии</title>
  <link rel="stylesheet" href="/css/style.css">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  <script type="text/javascript">
  $(function() {
    $("#send").click(function(){
      var author = $("#author").val();
      var message = $("#message").val();
      $.ajax({
        type: "POST",
        url: "sendMessage.php",
        data: {"author": author, "message": message},
        cache: false,
        success: function(response){
          var messageResp = new Array('Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения');
          var resultStat = messageResp[Number(response)];
          if(response == 0){
            $("#author").val("");
            $("#message").val("");
            $("#commentBlock").append("<div class='comment'>Автор: <strong>"+author+"</strong><br>"+message+"</div>");}
            $("#resp").text(resultStat).show().delay(1500).fadeOut(800);}});return false;});});
            </script>
          </head>
          
          <body>
            <form action="sendMessage.php" method="post" name="form">
              <p class="is-h">Автор:<br> <input name="author" type="text" class="is-input" id="author"></p>
              <p class="is-h">Текст сообщения:<br><textarea name="message" rows="5" cols="50" id="message"></textarea></p>
              <input name="js" type="hidden" value="no" id="js">
              <button type="submit" id='click' name="button" class="is-button">Отправить</button>
            </form>
            <div class="clear">
              
            </div>
            
            <p>Комментарии к статье</p>
            
            <div id="commentBlock">
              <?php
              $result = $mysql->query("SELECT * FROM `messages`");
              $comment = $result->fetch_assoc();
              do{echo "<div class='comment' style='border: 1px solid gray; margin-top: 1%; border-radius: 5px; padding: 0.5%;'>Автор: <strong>".$comment['author']."</strong><br>".$comment['message']."</div>";
              }while($comment = $result->fetch_assoc());
              ?>
            </div>
          </body>
          </html>