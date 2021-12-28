<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Contact Us</title>
</head>

<style>
    button,
    input {
        font-weight: 700;
        letter-spacing: 1.4px;
    }

    .background {
        display: flex;
    }

    .container {
        flex: 0 1 700px;
        margin: auto;
        padding: 10px;
    }

    .screen {
        position: relative;
        background: #03142d;
        border-radius: 15px;
    }

    .screen:after {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 20px;
        right: 20px;
        bottom: 0;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .4);
        z-index: -1;
    }

    .screen-header {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        background: #1e9e7d;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .screen-body {
        display: flex;
    }

    .screen-body-item {
        flex: 1;
        padding: 50px;
    }

    .screen-body-item.left {
        display: flex;
        flex-direction: column;
    }

    .app-title {
        display: flex;
        flex-direction: column;
        position: relative;
        color: #16c79a;
        font-size: 26px;
    }

    .app-title:after {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 25px;
        height: 4px;
        background: #16c79a;
    }

    .app-contact {
        margin-top: auto;
        font-size: 8px;
        color: #16c79a;
    }

    .app-form-group {
        margin-bottom: 15px;
    }

    .app-form-group.message {
        margin-top: 30px;
        margin-bottom: 50px;
        width: 250px;
        height: 40px;
    }

    textarea {
        height: 60px;
        font-weight: 700;
        letter-spacing: 1.4px;
        margin-top: 20px;
    }

    textarea::placeholder {
        font-size: 12px;
    }

    .app-form-group.buttons {
        margin-bottom: 0;
        text-align: right;
    }

    .app-form-control {
        width: 100%;
        padding: 10px 0;
        background: none;
        border: none;
        border-bottom: 1px solid #666;
        color: #eeeeee;
        font-size: 12px;
        text-transform: inherit;
        outline: none;
        transition: border-color .2s;
    }

    .app-form-control::placeholder {
        color: #666;
    }

    .app-form-control:focus {
        border-bottom-color: #eeeeee;
    }

    .app-form-button {
        background: none;
        border: none;
        color: #16c79a;
        font-size: 12px;
        cursor: pointer;
        outline: none;
        margin-top: 30px;
    }

    .app-form-button:hover {
        color: #1e9e7d;
    }

    .dribbble {
        width: 20px;
        height: 20px;
        margin: 0 5px;
    }

    @media screen and (max-width: 520px) {
        .screen-body {
            flex-direction: column;
        }

        .screen-body-item.left {
            margin-bottom: 30px;
        }

        .app-title {
            flex-direction: row;
        }

        .app-title span {
            margin-right: 12px;
        }

        .app-title:after {
            display: none;
        }
    }

    @media screen and (max-width: 600px) {
        .screen-body {
            padding: 40px;
        }

        .screen-body-item {
            padding: 0;
        }
    }
</style>

<?php include "nav.php" ?>

<body>
    <div class="background">
        <div class="container">
            <div class="screen">
                <div class="screen-header"></div>
                <form action="/Main/contactEmail" class="screen-body" method="post">
                    <div class="screen-body-item left">
                        <div class="app-title">
                            <span>CONTACT</span>
                            <span>US</span>
                        </div>
                        <div class="app-form-group message">
                            <textarea class="app-form-control" name="message" placeholder="MESSAGE" required></textarea>
                        </div>
                    </div>
                    <div class="screen-body-item">
                        <div class="app-form">
                            <div class="app-form-group">
                                <input class="app-form-control" name="name" placeholder="NAME" required>
                            </div>
                            <div class="app-form-group">
                                <input type="email" class="app-form-control" name="email" placeholder="EMAIL" required>
                            </div>
                            <div class="app-form-group">
                                <input type="tel" class="app-form-control" name="contact_no" placeholder="CONTACT NO" required>
                            </div>
                            <div class="app-form-group buttons">
                                <button class="app-form-button">CANCEL</button>
                                <button class="app-form-button">SEND</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>