<?php
include_once(getenv("ROOT")."views/components/header/header.php");
?>

<link rel="stylesheet" href='<?php echo SITE_URL ?>views/chat/style.css'>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

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
                <div class="card-body chat-care">
                    <ul class="chat">
                        <li class="agent clearfix">
                            <span class="chat-img left clearfix mx-2">
<!--                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="Agent" class="img-circle" />-->
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </li>
                        <li class="admin clearfix">
                            <span class="chat-img right clearfix  mx-2">
<!--                                <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="Admin" class="img-circle" />-->
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <small class="left text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="agent clearfix">
                            <span class="chat-img left clearfix mx-2">
<!--                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="Agent" class="img-circle" />-->
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </li>
                        <li class="admin clearfix">
                            <span class="chat-img right clearfix  mx-2">
<!--                                <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="Admin" class="img-circle" />-->
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <small class="left text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                    <strong class="right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor.
                                </p>
                            </div>
                        </li>
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
    $('.card-body').scrollTop(1000000);
    let socket = new WebSocket("ws://127.0.0.1:8000/ws/test");
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

    document.getElementById("btn-chat").addEventListener("click", onButtonClick)
    function onButtonClick(){
        const text = document.getElementById("btn-input")
        socket.send(text.value)
        text.value = "";
    }
</script>