<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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

    a {
        cursor: pointer;
    }

    h4 {
        text-align: center;
    }

    .form .form {
        padding: 1rem 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container-form {
        position: relative;
        margin: 1rem;
        border: 1px solid transparent;
        min-height: 500px;
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

    p {
        font-size: 0.75em;
        color: #DA0037;
        white-space: pre-line;
        text-align: center;
    }

    .input-error {
        margin: 0;
        padding: 0;
        font-size: 0.7rem;
        color: red;
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
        .container {
            margin: 2rem auto !important;
        }

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
        <div class="ctx" <?php if (isset($_GET["mail"])) { ?>style="top:50%" <?php } ?>>
            <div>
                <video class="border-round" autoplay muted loop style="height:320px">
                    <source src="/Public/assets/login-video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <!--  <img src="/Public/assets/login-image.jpg" /> -->
            </div>
            <?php if (isset($_GET["mail"])) { ?>
                <div class="flex-col flex-center margin-md">
                    <img src="/Public/assets/mail-gif.gif" alt="" style="height:200px">
                    <h2 class="flex-row flex-center margin-side-md">Check your email</h2>
                    <?php if (isset($_GET["forgot_password"])) { ?>
                        <h4 class="flex-row flex-center">we have sent a password recover instructions to your email</h4>
                    <?php } ?>
                    <?php if (isset($_GET["signup_mail"])) { ?>
                        <h4 class="flex-row flex-center">we have sent an email verification to your email</h4>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="container-form">
                    <div class="switcher">
                        <div class="switch-btn <?php if ($_GET["login"]) echo "shown"; ?>" onclick="switchf('login-form','signup-form')">Login</div>
                        <div class="switch-btn <?php if ($_GET["signup"]) echo "shown"; ?>" onclick="switchf('signup-form','login-form')">Sign Up</div>
                    </div>
                    <form action="/Login/validate" method="post" id="login-form" class="form <?php if ($_GET["login"]) echo "shown"; ?>">
                        <div class="form-item">
                            <label>Email</label>
                            <input name="email" class="form-ctrl" placeholder="&#xF007; &nbsp; Enter Email" required style="font-family:Arial, FontAwesome" />
                        </div>
                        <div class="form-item">
                            <label>Password</label>
                            <input type="password" name="password" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                        </div>
                        <span class="input-error"><?php if (isset($_GET["loginErr"]) && $_GET["loginErr"] != "") echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['loginErr']; ?></span>
                        <br>
                        <a onclick="switchf('forgot-form','login-form')">Forgot your password?</a>
                        <button type="submit" class="btn btn-solid margin-md">Login</button>
                    </form>
                    <form action="/Login/forgotPassword" method="post" id="forgot-form" class="form">
                        <div class="form-item">
                            <h4>No worries!<br>Enter your registered mail and we will send you a reset</h4>
                            <label>Enter your email</label>
                            <input name="email" class="form-ctrl" placeholder="&#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome" />
                        </div>
                        <button type="submit" class="btn btn-solid margin-md">Reset</button>
                    </form>
                    <div id="signup-form" class="form <?php if ($_GET["signup"]) echo "shown"; ?>">
                        <div style="max-width: 800px;margin: 0 auto;position:relative">
                            <div class="switcher">
                                <div class="switch-btn <?php if ($_GET["signupUser"]) echo "shown"; ?>" onclick="switchf('signup-form-user','signup-form-organisation')">
                                    User
                                </div>
                                <div class="switch-btn <?php if ($_GET["signupOrg"]) echo "shown"; ?>" onclick="switchf('signup-form-organisation','signup-form-user')">
                                    Organization
                                </div>
                            </div>
                            <form action="/Signup/validate" method="post" id="signup-form-user" class="form <?php if ($_GET["signupUser"]) echo "shown"; ?>">
                                <div class="form-item">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-ctrl" placeholder=" &#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome" maxlength="10" />
                                </div>
                                <div class="form-item">
                                    <label>Email</label>
                                    <span class="input-error email-error error"><?php if (isset($_GET["emailErr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['emailErr']; ?></span>
                                    <input type="email" name="email" class="form-ctrl" placeholder=" &#xf0e0; &nbsp; Enter Email" required style="font-family:Arial, FontAwesome" onkeyup="checkMail(this.value)" />
                                </div>
                                <div class="form-item">
                                    <label>Telephone</label>
                                    <span class="input-error telephone-error"><?php if (isset($_GET["telephoneErr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['telephoneErr']; ?></span>
                                    <input type="tel" name="contact_number" class="form-ctrl" placeholder="&#xf879; &nbsp; Enter phone number" required style="font-family:Arial, FontAwesome" />
                                </div>
                                <div class="form-item">
                                    <label>Password</label>
                                    <span class="input-error password-error error"><?php if (isset($_GET["passwordErr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['passwordErr']; ?></span>
                                    <input type="password" class="password-error form-ctrl" name="password" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                                </div>
                                <input name="signupUser" value="registered-user" type="hidden">
                                <button type="submit" class="btn btn-solid margin-md">Sign Up</button>
                            </form>
                            <form action="/Signup/validate" method="post" id="signup-form-organisation" class="form <?php if ($_GET["signupOrg"]) echo "shown"; ?>">
                                <div class="form-item">
                                    <label>Organization name</label>
                                    <input type="text" name="username" class="form-ctrl" placeholder=" &#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome" maxlength="10" />
                                </div>
                                <div class="form-item">
                                    <label>Email</label>
                                    <span class="input-error email-error error"><?php if (isset($_GET["emailErr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['emailErr']; ?></span>
                                    <input type="email" name="email" class="form-ctrl" onkeyup="checkMail(this.value)" placeholder=" &#xf0e0; &nbsp; Enter Email" required style="font-family:Arial, FontAwesome" onkeyup="checkMail(this.value)" />
                                </div>
                                <div class="form-item">
                                    <label>Telephone</label>
                                    <span class="input-error telephone-error"><?php if (isset($_GET["telephoneErr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['telephoneErr']; ?></span>
                                    <input type="text" name="contact_number" class="form-ctrl" placeholder="&#xf879; &nbsp; Enter phone number" required style="font-family:Arial, FontAwesome" />
                                </div>
                                <div class="form-item">
                                    <label>Password</label>
                                    <span class="input-error password-error error"><?php if (isset($_GET["passwordErr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['passwordErr']; ?></span>
                                    <input name="password" type="password" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                                </div>
                                <input name="signupOrg" value="organization" type="hidden">
                                <button type="submit" class="btn btn-solid margin-md">Sign Up</button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
</body>
<script src="/Public/assets/js/input_validation.js"></script>
<script>
    function switchf(id1, id2) {
        var forgot_form = document.getElementById("forgot-form");
        if (forgot_form.classList.contains("shown")) {
            if (id1 == 'login-form')
                id2 = 'forgot-form';
            else if (id1 == 'signup-form') {
                forgot_form.classList.remove("shown");
                for (const e of event.target.parentElement.children) {
                    e.classList.toggle("shown");
                }
            }
        } else
            for (const e of event.target.parentElement.children) {
                e.classList.toggle("shown");
            }

        let errors = document.querySelectorAll(".error");
        for (let error of errors) {
            error.innerHTML = "";
        }
        document.querySelector("#" + id1).classList.add("shown");
        document.querySelector("#" + id2).classList.remove("shown");

        /* errors = document.getElementsByTagName("span");

        for(var i = 0; i < errors.length; i++) {
            errors[i].innerHTML="";
        } */
    }
</script>


</html>