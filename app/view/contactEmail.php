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

    .app-form-group {
        margin-bottom: 15px;
    }

    .app-form-group.message {
        margin-top: 30px;
        margin-bottom: 50px;
        width: 250px;
        height: 40px;
    }

    h4,p {
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
</style>

<body>
    <div class="background">
        <div class="container">
            <div class="screen">
                <div class="screen-header"></div>
                <form action="Main/contactUs" class="screen-body" method="post">
                    <div class="screen-body-item left">
                        <div class="app-title">
                            <span>CONTACT</span>
                            <span>US</span>
                        </div>
                        <div class="app-form-group">
                            <h4>From : Venodi Widanagamage</h4>
                            <p>venodiwidanagamage@gmail.com</p>
                            <p>0776631087</p>
                        </div>
                        <div class="app-form-group message">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At vitae atque totam id eligendi commodi? Sed impedit nam eos magni dolore rem rerum! Omnis, inventore quod quas nostrum qui voluptas!</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>