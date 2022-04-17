<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once(getenv("ROOT")."views/components/header/header.php");
require_once(getenv("ROOT")."database/ChatHelper.php");
require_once(getenv("ROOT")."Session.php");

$user_id = Session::getLoggedInUserId();


$messages = ChatHelper::getMessagesByUserId($user_id);
//print_r($messages);
?>

<link rel="stylesheet" href='<?php echo SITE_URL ?>views/chat/style.css'>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->

<br>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <span>Chat Box</span>
                </div>
                <div class="card-body chat-care" id="card_msg">
                    <ul class="chat" id="message-ul">
                        <?php
                        if ($messages){
                        foreach ($messages as $message){
                            $side =  "agent";
                            if ($message['is_admin'] != 1)
                            {
                                $side = "admin";
                            }
                            echo <<< MESSAGE_ITEM
                            <li class="{$side} clearfix">
                          
                            <span class="chat-img left clearfix mx-2">
<!--                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="Agent" class="img-circle" />-->
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
<!--                                    <strong class="primary-font">{$message['name']}</strong> -->
                                    <small class="right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>{$message["create_time"]}</small>
                                </div>
                                <p>
                                    {$message["message"]}
                                </p>
                            </div>
                        </li>
MESSAGE_ITEM;
                            }
                        }

                        ?>

                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const user_id = <?php echo $user_id?>;
    $('.card-body').scrollTop(1000000);
    let socket = new WebSocket("ws://127.0.0.1:8000/ws/"+user_id);
    console.log("Attempting Connection...");

    socket.onopen = () => {
        console.log("Successfully Connected");
        // socket.send("Hi From the Client!")
    };

    socket.onclose = event => {
        console.log("Socket Closed Connection: ", event);
        socket.send("Client Closed!")
    };

    socket.onerror = error => {
        console.log("Socket Error: ", error);
    };

    socket.onmessage = event => {
        const message = JSON.parse(event.data);
        let side =  "agent";
        if (message['sender'] === user_id)
        {
            side = "admin";
        }
        const time = new Date().toLocaleString();
        const msgHtml = `
            <li class="${side} clearfix">

                            <span class="chat-img left clearfix mx-2">
<!--                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="Agent" class="img-circle" />-->
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">

<small class="right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>${time}</small>
                                </div>
                                <p>
                                    ${message["message"]}
                                </p>
                            </div>
                        </li>
        `;


        let message_ul = document.getElementById("message-ul");
        message_ul.insertAdjacentHTML('beforeend', msgHtml);
        let objDiv = document.getElementById("card_msg");
        objDiv.scrollTop = objDiv.scrollHeight;

    }

    document.getElementById("btn-chat").addEventListener("click", onButtonClick)
    function onButtonClick(){
        const text = document.getElementById("btn-input")
        let message = {
            sender: user_id,
            message: text.value
        }

        socket.send(JSON.stringify(message))
        text.value = "";
    }

    document.getElementById("btn-input")
        .addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("btn-chat").click();
            }
        });
</script>