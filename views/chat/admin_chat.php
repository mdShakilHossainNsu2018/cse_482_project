<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once(getenv("ROOT") . "views/components/header/header.php");
require_once(getenv("ROOT") . "database/ChatHelper.php");
require_once(getenv("ROOT") . "database/UserHelper.php");
require_once(getenv("ROOT") . "Session.php");

$admin_user_id = Session::getLoggedInUserId();

$users = UserHelper::getAllUsersExceptAdmin();

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$user_id = $queries["user_id"] ?? $users[0]["user_id"];

$messages = ChatHelper::getMessagesByUserId($user_id);
//print_r($messages);

?>

<link rel="stylesheet" href='<?php echo SITE_URL ?>views/chat/admin_chat.css'>


<!------ Include the above in your HEAD tag ---------->


<html>
<head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
          rel="stylesheet"

</head>
<body>
<div class="container">
    <h3 class="text-center">Admin Messaging Page</h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Peoples</h4>
                    </div>
                </div>
                <div class="inbox_chat">
                    <?php
                    if ($users) {

                        foreach ($users as $user) {
                            $user_url = SITE_URL."views/chat/admin_chat.php?user_id=".$user["user_id"];
                            $active_chat = $user_id == $user["user_id"] ? "active_chat" : "";
                            echo <<< USER_BLOCK
<a href="{$user_url}">
<div class="chat_list {$active_chat}">
                        <div class="chat_people">
                            <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png"
                                                       alt="sunil"></div>
                            <div class="chat_ib">
                                <h5>{$user['name']}</h5>
                                
                            </div>
                        </div>
                    </div>
</a>

USER_BLOCK;

                        }
                    }
                    ?>
                </div>
            </div>
            <div class="mesgs">
                <div class="msg_history" id="msg_block">
<!--                    <div class="incoming_msg" id="msg_block">-->
<!--                        <div class="incoming_msg_img">-->
<!--                            <img src="https://ptetutorials.com/images/user-profile.png"-->
<!--                                                           alt="sunil"></div>-->
                        <?php
                            foreach ($messages as $message){
                                $side1 =  "received_msg";
                                $side2 =  "received_withd_msg";
                                if ($message['is_admin'] == 1)
                                {
                                    $side1 = "outgoing_msg";
                                    $side2 = "sent_msg";
                                }
                                echo <<< MESSAGE_BLOCK
                                  <div class="{$side1}">
<!--                                  <h1>{mess}</h1>-->
                            <div class="{$side2}">
                                <p>{$message['message']}</p>
                                <span class="time_date">{$message['create_time']}</span></div>
                        </div>  
MESSAGE_BLOCK;


                            }
                        ?>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" id="message_input" class="write_msg" placeholder="Type a message"/>
                        <button id="send_btn" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const admin_user_id = <?php echo $admin_user_id;?>;
    const user_id = <?php echo $user_id;?>;
    // for scroll down
    $('.msg_history').scrollTop(1000000);
    const users = <?php echo JSON_encode($users);?>;
    users.forEach(obj => {

    })
    let socket = new WebSocket("ws://127.0.0.1:8000/ws/" + user_id);
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
        console.log(event);
        const message = JSON.parse(event.data);
        let side1 =  "received_msg";
        let side2 =  "received_withd_msg";
        if (message["sender"] === admin_user_id){
            side1 = "outgoing_msg";
            side2 = "sent_msg";
        }
        const time = new Date().toLocaleString();
        const html = `
        <div class="${side1}">
            <!--                                  <h1>{mess}</h1>-->
            <div class="${side2}">
                <p>${message['message']}</p>
                <span class="time_date">${time}</span></div>
        </div>

        `;
        let incoming_msg = document.getElementById("msg_block");
        incoming_msg.insertAdjacentHTML('beforeend', html);
        let objDiv = document.getElementById("msg_block");
        objDiv.scrollTop = objDiv.scrollHeight;

    }

    document.getElementById("send_btn").addEventListener("click", onButtonClick)

    function onButtonClick() {
        const text = document.getElementById("message_input")
        let message = {
            sender: admin_user_id,
            message: text.value
        }

        socket.send(JSON.stringify(message))
        text.value = "";
    }

    document.getElementById("message_input")
        .addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("send_btn").click();
            }
        });
</script>

</body>
</html>
