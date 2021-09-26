<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/assets/style/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../Public/assets/style/profilestyle.css">
    <link rel="stylesheet" href="../Public/assets/style/fontawesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>admin profile</title>


</head>
<?php if($admin) include "nav.php"?>
<body>
    <div class="profilecontainer">
        <div class="profilecontainer-top">
            <form action="/User/updateProflePic" method="post" class="profilepic-pic-div">
                <img src="<?= $profile_pic ?>" id="dp">
                <input type="file" id="file">
                <label for="file" id="uploadbtn">upload photo</label>

            </form>

            <div class="aboutme-container">
                <div class="intro">
                    <h2 id="name"><?= $username; ?></h2>
                </div>

                <a href="activityLog" class="view-activitylog-btn" role="button"><i class="fa fa-history"></i>&nbsp&nbspActivity log</a>

            </div>





            <div class="details-settings">
                <h2>Details</h2>
                <hr>

                <div class="details">



                    <div class="username-container">
                        <div class="username-icon">
                            <i class="fa fa-user-circle fa-2x clr-gray" id="user"></i>
                            <label id="user-label">Username</label>
                        </div>

                        <div class="username">
                            <h3 id="username"><?= $username ?></h3>

                        </div>
                        <div class="username-change-btn">
                            <button class="btn btn-clr" type="button" onclick="showEddite('usernameupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                        </div>
                    </div>

                    <!--username update form-->
                    <form action="/User/updateUsername" method="post" id="edit-user-profile-form">
                        <div class="update-form" id="usernameupdater">
                            <div class="input-container">
                                <label for="text" class="edit-coontainer">Enter new username:</label>
                                <input type="text" id="usernameinput" placeholder="Enter new username" name="username"><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white" onclick=" updateField('username','usernameupdater')">Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick="showEddite('usernameupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>





                    <div class="mobile-container">
                        <div class="mobile-icon">
                            <i class="far fa-mobile-alt fa-2x" id="mobi"></i>
                            <label for="mobi" id="mobile-label">Mobile</label>
                        </div>

                        <div class="mobile" id="mobile">
                            <h3><?= $contact_number ?></h3>

                        </div>
                        <div class="mobile-change-btn">
                            <button class="btn btn-clr" type="button" onclick=" showEddite('mobileupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                        </div>

                    </div>

                    <!--mobile update form-->
                    <form action="/User/updateContactNumber" method="post" id="edit-user-profile-form">
                        <div class="update-form" id="mobileupdater">
                            <div class="input-container">

                                <label for="text" class="form-item label">Enter new mobile:</label>

                                <input type="text" placeholder="Enter new mobile" required name="contact_number" onkeyup="checkTelephone(this.value)"><br>
                                <p class="alert mobile-error"></p>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white mobile-submit-btn" onclick=" updateField('mobile','mobileupdater')">Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick=" showEddite('mobileupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>



                </div>




            </div>
            <div class="login-settings">
                <h2>Login-info</h2>
                <hr>

                <div class="login-info">



                    <div class="email-container">
                        <div class="email-icon">
                            <i class="far fa-envelope fa-2x" id="envelope"></i>
                            <label for="envelope" id="envelope-label">Email</label>
                        </div>

                        <div class="email">
                            <h3 id="email"><?= $email; ?></h3>
                        </div>

                        <div class="email-change-btn">
                            <button class="btn btn-clr" type="button" onclick=" showEddite('emailupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                        </div>

                    </div>

                    <!--email update form-->
                    <form action="/User/updateEmail" method="post" id="edit-user-profile-form">
                        <div class="update-form" id="emailupdater">
                            <div class="input-container">
                                <label for="text">Enter new email:</label>
                                <input type="text" placeholder="Enter new email" name="email" required onkeyup="checkMail(this.value)" /><br>
                                <p class="alert email-error"><?php if (isset($_GET['invaliderr'])) {
                                                                    echo $_GET['invaliderr'];
                                                                } ?></p>

                                <div class="intro-update-btn">
                                    <button type="submit" id="email-submit-btn" class="btn bg-green clr-white" onclick=" updateField('email','emailupdater')" <?php if (isset($_GET['invaliderr'])) {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick=" showEddite('emailupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>



                    <div class="password-container">
                        <div class="password-icon">
                            <i class="fa fa-key fa-2x clr-gray" id="pass"></i>
                            <label id="password-label">Password</label>
                        </div>

                        <div class="password">
                            <input type="password" id="password" value="************" disabled><br>
                        </div>
                        <div class="password-change-btn">
                            <button class="btn btn-clr" type="button" onclick="showEddite('passwordupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                        </div>

                    </div>

                    <!--password update form-->
                    <form action="/User/updatePassword" method="post" id="edit-user-profile-form">
                        <div class="update-form" id="passwordupdater">
                            <div class="input-container">

                                <label for="password" class="form-item label">Enter current password:</label>
                                <input type="password" placeholder="Enter current password" id="passwordinputold" name="current_password" onkeyup="clearCurrentpasswordError()"><br>
                                <p class="alert current-password-error"><?php if (isset($_GET['currentpassworderr'])) {
                                                                            echo $_GET['currentpassworderr'];
                                                                        } ?></p>

                                <label for="password" class="form-item label">Enter new password: </label>
                                <input type="password" placeholder="Enter new password" id="new-password" name="new_password" onkeyup="checkPassword(this.value)"><br>
                                <p class="alert password-error"></p>


                                <label for="password" class="form-item label">Confirm password:</label>
                                <input type="password" placeholder="Enter confirm password" id="confirm-password" name="password" onkeyup="passwordMatch(this.value)"><br>

                                <p class="alert" id="confirm-password-error" style="color: #16c79a; text-align:center;"></p>


                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white password-submit-btn" onclick="showEddite('passwordupdater')" <?php if (isset($_GET['currentpassworderr'])) {
                                                                                                                                                            echo "disabled";
                                                                                                                                                        } ?>>Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick="showEddite('passwordupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>




            </div>


        </div>

    </div>




    </div>


    <script src="../Public/assets/js/adminProfilePic.js"></script>

    <script>
        <?php if (isset($_GET["invaliderr"])) echo "showEddite('emailupdater');" ?>
        <?php if (isset($_GET["currentpassworderr"])) echo "showEddite('passwordupdater');" ?>


        function clearCurrentpasswordError() {
            let current_password_error = document.querySelector(".current-password-error");
            current_password_error.innerHTML = "";


        }

        function checkTelephone(number) {
            var err = "";
            const pattern = /^[+]?[0-9]{10,11}$/;
            if (!pattern.test(number)) {
                var err = "Valid phone number required";
                document.querySelector('.mobile-submit-btn').disabled = true;
            } else {
                document.querySelector('.mobile-submit-btn').disabled = false;
            }
            let mobile_errors = document.querySelector(".mobile-error");


            mobile_errors.innerText = err;



        }



        function checkMail(email) {

            if (email.length == 0) {
                let email_errors = document.querySelector(".email-error");
                for (let error of email_errors) {
                    error.innerHTML = "";
                }
                return;
            } else

                $.ajax({
                    url: "/User/checkEmailAvailable",
                    type: "post",
                    dataType: 'json',
                    data: {
                        email: email
                    },
                    success: function(result) {

                        if (result.taken == true) {
                            var err = "Email already taken";
                            document.getElementById('email-submit-btn').disabled = true;
                        } else {
                            var err = "";
                            document.getElementById('email-submit-btn').disabled = false;
                        }


                        let email_error = document.querySelector(".email-error")
                        email_error.innerHTML = err;




                    }
                });
        }

        function checkPassword(password) {
            var err = "";
            const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!pattern.test(password)) {
                var err = "Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols";
                document.querySelector('.password-submit-btn').disabled = true;

            } else {
                document.querySelector('.password-submit-btn').disabled = false;
            }

            let password_errors = document.querySelectorAll(".password-error");
            for (let error of password_errors) {
                error.innerHTML = err;
            }
        }


        function showEddite(elementId) {
            // alert()
            document.getElementById(elementId).classList.toggle("unhide");

        }

        function updateField(elementId, containerID) {

            document.getElementById(elementId).innerText = document.getElementById(elementId + 'input').value;
            document.getElementById(containerID).classList.toggle("hide");

        }

        function passwordMatch(confirm_password) {

            const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let new_password = document.getElementById('new-password');
            let alert = document.getElementById("confirm-password-error");

            console.log(new_password.value);
            console.log(confirm_password);
            if (new_password.value == confirm_password && pattern.test(new_password.value)) {

                alert.innerText = "Password matched";
                document.querySelector('.password-submit-btn').disabled = false;
                alert.style.color = "green";
            } else {
                document.querySelector('.password-submit-btn').disabled = true;
                alert.innerText = "Still not matched with current passowrd";
                alert.style.color = "red";

            }


        }
    </script>
</body>

<?php include "footer.php"?>

</html>