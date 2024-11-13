<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <ul class="msg-list">
            </ul>
        </div>
        <form method="post" id="chatForm">
            <div class="form-group">
                <label for="message"></label>
                <input type="text" name="message" id="message" class="form-control" />
            </div>
            <div>
                <input type="submit" id="subBtn" class="btn btn-info" value="send">
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> 
    $(document).ready(function() {
        var connection = new WebSocket('ws://127.0.0.1:8080');
        var chatForm = $('#chatForm');
        var userMessage = $("#message");
        var msgList = $('.msg-list');
        chatForm.on('submit', function(e){
            e.preventDefault();
            var message = userMessage.val();
            connection.send(message);
            console.log(connection);

            msgList.prepend("<li style='color:blue;'>" + message +"</li>");
        });
        connection.onopen = function(e) {
            console.log("Connection stablished");
        }
        connection.onmessage = function(e) {
            console.log(e.data);
            msgList.prepend("<li style='color:red;'>" + e.data + "</li>");
        }        
    });
    // var conn = new WebSocket('ws://localhost:8080/echo');
    // conn.onmessage = function(e) { console.log(e.data); };
    // conn.onopen = function(e) { conn.send('Hello Me!'); };
    </script>
</body>
</html>