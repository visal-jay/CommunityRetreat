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
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
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

    .error {
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
                    <div class="switch-btn <?php if ($_GET["login"]) echo "shown"; ?>" onclick="switchf('login-form','signup-form')">Login</div>
                    <div class="switch-btn <?php if ($_GET["signup"]) echo "shown"; ?>" onclick="switchf('signup-form','login-form')">Sign Up</div>
                </div>
                <form action="/Login/validate" method="post" id="login-form" class="form <?php if ($_GET["login"]) echo "shown"; ?>">
                    <div class="form-item">
                        <label>Username</label>
                        <input name="email" class="form-ctrl" placeholder="&#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome" />
                    </div>
                    <div class="form-item">
                        <label>Password</label>
                        <input type="password" name="password" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                    </div>
                    <p class="error" style="margin:0px"><?php echo $_GET["loginErr"]; ?></p>
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
                                <input type="text" name="username" class="form-ctrl" placeholder=" &#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome" onkeyup="checkMail(this.value)" />
                                <p class="error email-error" style="margin:0px"><?php echo $_GET["emailErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Email</label>
                                <input type="text" name="email" class="form-ctrl" onkeyup="checkMail(this.value)" placeholder=" &#xf0e0; &nbsp; Enter Email" required style="font-family:Arial, FontAwesome" onkeyup="checkMail(this.value)" />
                                <p class="error email-error" style="margin:0px"><?php echo $_GET["emailErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Telephone</label>
                                <input type="text" name="contact_number" class="form-ctrl" onkeyup="checkTelephone(this.value)" placeholder="&#xf879; &nbsp; Enter phone number" required style="font-family:Arial, FontAwesome" />
                                <p class="error telephone-error" style="margin:0px"><?php echo $_GET["telephoneErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Password</label>
                                <input type="password" name="password" onkeyup="checkPassword(this.value)" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                                <p class="error password-error" style="margin:0px"><?php echo $_GET["passwordErr"]; ?></p>
                            </div>
                            
                            <button name="signupUser" type="submit" class="btn btn-solid margin-md" value="registered-user">Sign Up</button>
                        </form>
                        <form action="/Signup/validate" method="post" id="signup-form-organisation" class="form <?php if ($_GET["signupOrg"]) echo "shown"; ?>">
                            <div class="form-item">
                                <label>Organization name</label>
                                <input type="text" name="username" class="form-ctrl" placeholder=" &#xF007; &nbsp; Enter Username" required style="font-family:Arial, FontAwesome" onkeyup="checkMail(this.value)" />
                                <p class="error email-error" style="margin:0px"><?php echo $_GET["emailErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Email</label>
                                <input type="text" name="email" class="form-ctrl" onkeyup="checkMail(this.value)" placeholder=" &#xf0e0; &nbsp; Enter Email" required style="font-family:Arial, FontAwesome" onkeyup="checkMail(this.value)" />
                                <p class="error email-error" style="margin:0px"><?php echo $_GET["emailErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Telephone</label>
                                <input type="text" name="contact_number" class="form-ctrl" onkeyup="checkTelephone(this.value)" placeholder="&#xf879; &nbsp; Enter phone number" required style="font-family:Arial, FontAwesome" />
                                <p class="error telephone-error" style="margin:0px"><?php echo $_GET["telephoneErr"]; ?></p>
                            </div>
                            <div class="form-item">
                                <label>Password</label>
                                <input name="password" type="password" onkeyup="checkPassword(this.value)" class="form-ctrl" placeholder="&#xf13e; &nbsp; Enter Password" required style="font-family:Arial, FontAwesome" />
                                <p class="error password-error" style="margin:0px"><?php echo $_GET["passwordErr"]; ?></p>
                            </div>
                            <button type="submit" class="btn btn-solid margin-md" value="organization" name="signupOrg">Sign Up</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
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
            }

            function checkMail(email) {
                if (email.length == 0) {
                    let email_errors = document.querySelectorAll(".email-error");
                    for (let error of email_errors) {
                        error.innerHTML = "";
                    }
                    return;
                } else

                    $.ajax({
                        url: "/Signup/checkEmailAvailable", //the page containing php script
                        type: "post", //request type,
                        dataType: 'json',
                        data: {
                            email: email
                        },
                        success: function(result) {
                            if (result.taken == true) {
                                var err = "Email already taken";
                            } else
                                var err = "";
                            let errors = document.querySelectorAll(".email-error");
                            for (let error of errors) {
                                error.innerHTML = err;
                            }
                        }
                    });
            }

            function checkPassword(password) {
                var err = "";
                const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!pattern.test(password))
                    var err = "Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols";
                let password_errors = document.querySelectorAll(".password-error");
                for (let error of password_errors) {
                    error.innerHTML = err;
                }
            }

            function checkTelephone(number) {
                var err = "";
                const pattern = /^[+]?[0-9]{10,11}$/;
                if (!pattern.test(number))
                    var err = "Valid phone number required";
                let telephone_errors = document.querySelectorAll(".telephone-error");
                for (let error of telephone_errors) {
                    error.innerHTML = err;
                }
            }
        </script>


    </div>
</body>

</html>