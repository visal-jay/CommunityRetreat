<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Document</title>
</head>
<style>
    .chatlist {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem 2rem 0 2rem;
        box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
        height: 100vh;
        width: 35%;
        overflow-y: scroll;
        min-width: 375px;
        box-sizing: border-box;
    }

    .chat-user-photo {
        border-radius: 100%;
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .chat-user-card {
        width: 80%;
        min-width: 300px;
        margin-bottom: 1rem;
        box-shadow: rgba(27, 31, 35, 0.04) 0px 1px 0px, rgba(255, 255, 255, 0.25) 0px 1px 0px inset;
    }

    .chat-messages{
        height: 90%;
        overflow-y: scroll;
    }

    .chatlist p,
    h3 {
        margin: 0;
        white-space: nowrap;
        text-overflow: ellipsis;

    }

    .flex-space-between {
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .chat-box {
        box-sizing: border-box;
        height: 100vh;
        background-color: #8080800d;
        width: 70%;
        padding: 1rem 3rem;
        min-width: 600px;
        position: relative;

    }

    .chat {
        width: 100%;
    }

    .reciever-text {
        padding: 1rem;
        width: fit-content;
        max-width: 70%;
        float: left;
        background-color: white;
        border-radius: 10px 10px 10px 2px;
        box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
    }

    .sender-text {
        padding: 1rem;
        width: fit-content;
        max-width: 70%;
        float: right;
        background-color: grey;
        color: white;
        border-radius: 10px 10px 2px 10px;
        box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
    }


    .form-ctrl {
        width: 80%;
        margin-bottom: 0px;
    }

    .chat-input {
        position: absolute;
        width: 80%;
        bottom: 0;
        left: 50%;
        right: 50%;
        transform: translate(-50%, 0%);
        background-color: white;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        padding: 2rem 0;
        border-radius: 8px 8px 0px 0px;
    }

    .hidden {
        display: none !important;
    }

    .chat-back-button {
        display: none;
    }

    @media screen and (max-width:800px) {
        .chat-box {
            width: 100%;
            min-width: 100px;
            padding: 1rem 1rem;
        }

        .chatlist {
            width: 100%;
        }

        .chat-back-button {
            display: flex;
        }
    }
</style>

<body>
    <div class="flex-row">
        <div class="chatlist">
            <div class="chat-user-card flex-row flex-center">
                <div>
                    <img class="chat-user-photo" src="/Public/assets/user-sample-1.gif" alt="">
                </div>
                <div class="flex-row flex-space-around">
                    <div class="flex-col margin-side-lg">
                        <h3>Test User</h3>
                        <p>This is a test message</p>
                    </div>
                    <i class="fas fa-circle clr-green"></i>
                </div>
            </div>
            <div class="chat-user-card flex-row flex-center">
                <div>
                    <img class="chat-user-photo" src="/Public/assets/user-sample-1.gif" alt="">
                </div>
                <div class="flex-row flex-space-around">
                    <div class="flex-col margin-side-lg">
                        <h3>Test User</h3>
                        <p>This is a test message</p>
                    </div>
                    <i class="fas fa-circle clr-green"></i>
                </div>
            </div>
            <div class="chat-user-card flex-row flex-center">
                <div>
                    <img class="chat-user-photo" src="/Public/assets/user-sample-1.gif" alt="">
                </div>
                <div class="flex-row flex-space-around">
                    <div class="flex-col margin-side-lg">
                        <h3>Test User</h3>
                        <p>This is a test message</p>
                    </div>
                    <i class="fas fa-circle clr-green"></i>
                </div>
            </div>

        </div>
        <div class="chat-box">
            <button class="btn-icon chat-back-button" style="font-family: FontAwesome;font-size:1.2rem">&#xf060;</button>
            <div class="chat-messages flex-col">
                <div class="flex-row flex-center">Chat with with Organisations</div>
            </div>
            <div class="chat-input flex-row flex-center">
                <input type="text" class="form-ctrl" id="chat-input">
                <button type="button" id="chat-send-button" class="btn-icon" style="font-family: FontAwesome;font-size:1.2rem" onclick="sendMessage();">&#xf1d8;</button>
            </div>
        </div>

    </div>
</body>
<script>
    document.querySelector('.chat-back-button').addEventListener('click', () => {
        document.querySelector('.chat-box').classList.toggle('hidden');
        document.querySelector('.chatlist').classList.toggle('hidden');
    });

    function displayChat() {
        var chat_box = document.querySelector('.chat-box');
        var chat_list = document.querySelector('.chatlist');
        if (window.innerWidth <= 800 && !chat_box.classList.contains('hidden') && !chat_list.classList.contains('hidden')) {
            chat_box.classList.add('hidden');
        }
        if (window.innerWidth > 800) {
            console.log('hdksadfk');
            chat_box.classList.remove('hidden');
            document.querySelector('.chatlist').classList.remove('hidden');

        }
    }
    window.addEventListener('resize', displayChat);
    window.addEventListener('load', displayChat);


    function createElementFromHTML(htmlString) {
        var div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    var message_interval = 0;
    var last_message="";
    async function getMessages(uid) {
        var message_body="";
        let parent_container = document.querySelector('.chat-messages');
        document.getElementById("chat-send-button").value = uid;
        $.ajax({
            url: "/Message/getMessages", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                uid: uid
            },
            success: function(result) {
                parent_container.innerHTML = "";
                result.forEach(msg => {
                    let template = `
                    <div class="margin-md">
                        <div class="${msg.is_sender==1? 'sender-text':'reciever-text'}">${msg.message}</div>
                    </div>`;
                    message_body=message_body+template;
                    parent_container.appendChild(createElementFromHTML(template));
                });
                if(last_message!=message_body){
                    last_message=message_body;
                    parent_container.scrollTop = parent_container.scrollHeight;
                }

            }
        });
        if (message_interval == 0) {
            message_interval = 1;
            createInterval(getMessages, uid, 500);
        }
    }

    chat_list = [];
    chat_list_initial = 1;

    function exists(arr, search) {
        return arr.some(row => row.includes(search));
    }

    function existsList(arr, search) {
        return arr.some(row => JSON.stringify(row) == JSON.stringify(search));
    }

    function deleteList(arr, search) {
        return JSON.stringify(row) != JSON.stringify(search);
    }


    async function chatList() {
        console.log("chatlist");

        let parent_container = document.querySelector('.chatlist');
        var chat_body = "";
        $.ajax({
            url: "/Message/getchatList", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            success: function(result) {
                result.forEach(usr => {
                    if (!existsList(chat_list, [usr.uid, usr.time_stamp])) {
                        console.log("chatlist");

                        if (exists(chat_list, usr.uid)) {
                            chat_list = chat_list.filter((e) => {return e[0] != usr.uid});
                            document.getElementById(usr.uid).remove();
                        }

                        chat_list.push([usr.uid, usr.time_stamp]);
                        console.log(chat_list);
                        let template = `
                        <div class="chat-user-card flex-row" id="${usr.uid}" onclick="getMessages('${usr.uid}');">
                            <div>
                                <img class="chat-user-photo" src="${usr.photo}" alt="">
                            </div>
                            <div class="flex-row flex-space-between">
                                <div class="flex-col margin-side-lg">
                                    <h3>${usr.username}</h3>
                                    <p class="last-message">${usr.message}</p>
                                </div>
                                <i class="fas fa-circle ${(usr.seen==0 && usr.is_sender==0) ? 'clr-green':'clr-white'}"></i>
                            </div>
                        </div>`;
                        chat_body = chat_body + template;
                    }
                });
                if (chat_list_initial == 1) {
                    parent_container.innerHTML = "";
                    chat_list_initial = 0;
                }

                if (chat_body != "") {
                    parent_container.insertAdjacentElement("afterbegin", createElementFromHTML(chat_body));
                }

                document.querySelectorAll('.chat-user-card').forEach(item => {
                    item.addEventListener('click', event => {
                        var chat_box = document.querySelector('.chat-box');
                        event.target.getElementsByTagName("i")[0].classList.remove("clr-green");
                        event.target.getElementsByTagName("i")[0].classList.add("clr-white");
                        if (window.innerWidth <= 800 && chat_box.classList.contains('hidden')) {
                            var chat_list = document.querySelector('.chatlist');
                            chat_box.classList.toggle('hidden');
                            chat_list.classList.toggle('hidden');
                        }
                    })
                });
            }
        });
    }

    async function sendMessage() {
        var message = document.getElementById("chat-input").value;
        var reciever = document.getElementById("chat-send-button").value;
        document.getElementById("chat-input").value = "";
        if (message != "") {
            document.getElementById(reciever).querySelector('.last-message').innerHTML = message;
            $.ajax({
                url: "/Message/sendMessage", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    reciever: reciever,
                    message: message,
                },
                success: function(result) {}
            });
        }
    }

    function createInterval(f, dynamicParameter, interval) {
        setInterval(function() {
            f(dynamicParameter);
        }, interval);
    }



    //chatList();
    //chatList();
    setInterval(function() {
        chatList();
    }, 1000);
</script>

</html>