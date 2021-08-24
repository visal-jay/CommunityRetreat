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
    .form {

        width: 100%;
        box-sizing: border-box;
    }

    .container {
        border: 1px solid grey;
        border-radius: 8px;
        padding: 1rem;
        margin: 0;
        height: fit-content;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .container-form {
        margin: 1rem;
        border: 1px solid transparent;
        max-height: max-content;
        max-width: 300px;
        min-width: 280px
    }
    .password-error{
        font-size: 0.75em;
    }

    @media (max-width:800px) {
        .container{
            width: 70%;
        }
        .container-form{
            min-width: 230px;
        }
    }
</style>

<body>
    <div class="container">
        <div class="container-form">
            <form action="/Login/resetPassword?key=<?= $key?>" method="post" class="form shown" name="reset-password" onsubmit="return confirmPassword()">
                <h2>Reset your password</h2>
                <div class="form-item">
                    <label>Enter new password</label>
                    <input name="password" type="password" class="form-ctrl" onkeyup="checkPassword(this.value)" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                </div>
                <div class="form-item">
                    <label>Confirm password</label>
                    <input name="password-cnf" type="password" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                </div>
                <p class="password-error clr-red" style="margin:0px"></p>
                <button type="submit" class="btn btn-solid margin-md">Reset</button>
            </form>
        </div>
    </div>
</body>
<script>
    
    function checkPassword(password) {
        var err = "";
        const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!pattern.test(password))
            var err = "Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols";
        document.querySelectorAll(".password-error")[0].innerHTML=err;  
    }

    function confirmPassword(){
        var form=document.forms["reset-password"];
        if (form["password"].value!=form["password-cnf"].value){
            document.querySelectorAll(".password-error")[0].innerHTML="Passwords don't match";
            return false;
        }
    }
</script>




</html>