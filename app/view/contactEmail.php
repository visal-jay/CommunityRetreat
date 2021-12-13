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
    <div style="display:flex">
        <div style="flex: 0 1 700px; margin: auto; padding: 10px">
            <div style="position: relative; background: #03142d; border-radius: 15px">
                <div style="display: flex; align-items: center; padding: 10px 20px; background: #1e9e7d; border-top-left-radius: 15px; border-top-right-radius: 15px"></div>
                <form action="Main/contactUs" style="display: flex" method="post">
                    <div style="flex: 1; padding: 50px; display: flex; flex-direction: column">
                        
                        <div style="margin-bottom: 15px">
                        <div style="display: flex; flex-direction: column; position: relative; color: #16c79a; font-size: 26px">
                            <span>CONTACTED US</span>
                        </div>
                            <h4 style="width: 100%; padding: 10px 0; background: none; border: none; border-bottom: 1px solid #666; color: #eeeeee; font-size: 12px; text-transform: inherit; outline: none; transition: border-color .2s">From : <?= $name ?> </h4>
                            <p style="width: 100%; padding: 10px 0; background: none; border: none; border-bottom: 1px solid #666; color: #eeeeee; font-size: 12px; text-transform: inherit; outline: none; transition: border-color .2s">Email : <?= $email ?></p>
                            <p style="width: 100%; padding: 10px 0; background: none; border: none; border-bottom: 1px solid #666; color: #eeeeee; font-size: 12px; text-transform: inherit; outline: none; transition: border-color .2s">Contact Number : <?= $contact_no ?></p>
                            <p style="width: 100%; padding: 10px 0; background: none; border: none; border-bottom: 1px solid #666; color: #eeeeee; font-size: 12px; text-transform: inherit; outline: none; transition: border-color .2s">Message: <br> <?= $message ?></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>