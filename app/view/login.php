<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    .switcher {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .switch-btn {
        cursor: pointer;
        padding: .8rem;
        text-align: center;
        border: 1px solid #16C79A;
        color: #16C79A;
    }

    .switch-btn.shown {
        background-color: #16C79A;
        color: white;
    }

    .form .switch-btn {
        padding: .4rem;
    }

    .form {
        position: absolute;
        left: -100%;
        padding: 1rem;
        transition: all .5s ease-in-out;
        opacity: 0;
        width: 100%;
        box-sizing: border-box;
    }

    .form.shown {
        opacity: 1;
        left: 0;
    }

    .form .form {
        padding: 1rem 0;
    }

    .container-form {

        position: relative;
        margin: 1rem;
        border: 1px solid transparent;
        min-height: 400px;
        max-height: max-content;
        overflow: hidden;
        max-width: 300px;
        min-width: 280px
    }

    .ctx {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 4rem;
        max-width: 800px;
        margin: 0 auto;

    }

    .ctx div img {
        height: 300px;
    }

    p{
        font-size: 0.75em;
        color: #DA0037;
        white-space: pre-line;
        text-align: center;
    }
    
    .error{
        margin: 0;
        padding: 0;
    }
    @media (max-width:1000px) {
        .ctx {
            grid-gap: 1rem;

        }

        .ctx div img {
            height: 250px;
        }
    }

    @media (max-width:800px) {
        .ctx {
            grid-template-columns: 1fr;
            justify-items: center
        }

        .ctx div img {
            height: 180px;
        }

    }
</style>

<?php include "nav.php" ?>

<body>
    <div class="container">

        <div class="ctx">
            <div><img src="/Public/assets/login-image.jpg" /></div>
            <div class="container-form">
                <div class="switcher">
                    <div class="switch-btn <?php if($_GET["login"]) echo "shown";?>" onclick="switchf('login-form','signup-form')">Login</div>
                    <div class="switch-btn <?php if($_GET["signup"]) echo "shown";?>" onclick="switchf('signup-form','login-form')">Sign Up</div>
                </div>
                <form id="login-form" class="form <?php if($_GET["login"]) echo "shown";?>">
                    <div class="form-item">
                        <label>Username</label>
                        <input class="form-ctrl" placeholder="&#xF007; &nbsp; Enter Username"/>
                    </div>
                    <div class="form-item">
                        <label>Password</label>
                        <input class="form-ctrl" placeholder="&#xF007; &nbsp; Enter Password"/>
                    </div>
                    <button type="submit" class="btn btn-solid ">Login</button>
                </form>
                <div id="signup-form" class="form <?php if($_GET["signup"]) echo "shown";?>">
                    <div style="max-width: 800px;margin: 0 auto;position:relative">
                        <div class="switcher">
                            <div class="switch-btn <?php if($_GET["signupUser"]) echo "shown";?>" onclick="switchf('signup-form-user','signup-form-organisation')">
                                User
                            </div>
                            <div class="switch-btn <?php if($_GET["signupOrg"]) echo "shown";?>" onclick="switchf('signup-form-organisation','signup-form-user')">
                                Organization
                            </div>
                        </div>
                        <form action="/Signup/validate" method="post" id="signup-form-user" class="form <?php if($_GET["signupUser"]) echo "shown";?>">
                            <div class="form-item">
                                <label>Username</label>
                                <input type="text" name="email" class="form-ctrl" placeholder=" &#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome"/>
                                <p class="error" style="margin:0px"><?php echo $_GET["emailErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Password</label>
                                <input type="password" name="password" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome"/>
                                <p class="error" style="margin:0px"><?php  echo $_GET["passwordErr"]; ?></p>
                            </div>
                            <button name="signupUser" type="submit" class="btn btn-solid margin-md" >Sign Up</button>
                        </form>
                        <form action="/Signup/validate" method="post" id="signup-form-organisation" class="form <?php if($_GET["signupOrg"]) echo "shown";?>">
                            <div class="form-item">
                                <label>Organisation</label>
                                <input name="email" class="form-ctrl" placeholder="&#xF007; &nbsp; Enter Oragnisation Name" required style="font-family:Arial, FontAwesome"/>
                                <p class="error" style="margin:0px"><?php echo $_GET["emailErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Password</label>
                                <input  name="password" type="password" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome"/>
                                <p class="error" style="margin:0px"><?php echo $_GET["passwordErr"]; ?></p>
                            </div>
                            <button type="submit" class="btn btn-solid margin-md" name="signupOrg" >Sign Up</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <script>
            function switchf(id1, id2) {
                for (const e of event.target.parentElement.children) {
                    e.classList.toggle("shown");
                }
                
                let errors = document.querySelectorAll(".error");
                for (let error of errors){
                    error.remove();
                }
                document.querySelector("#" + id1).classList.add("shown")
                document.querySelector("#" + id2).classList.remove("shown")
            }
        </script>


    </div>
</body>

</html>