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
    <title>Registrationuser profile</title>


</head>

<body class="body">

    <?php if($registered_user) include "nav.php" ?>


   <!-- Main-container -->
    <div class="profilecontainer">
        <div class="profilecontainer-top">
              <!-- Profile container division -->
            <div class="profilepic-pic-div">
                <img src="<?= $profile_pic ?>" id="dp">
                <input type="file" id="file" name="profile_pic">
                <label for="file" id="uploadbtn">upload photo</label>

            </div>

            <div class="aboutme-container">
                <div class="intro">
                    <h2 id="name"><?= $username; ?></h2>
                </div>
            <!-- Activity-log-button -->
                <a href="activityLog" class="view-activitylog-btn" role="button"><i class="fa fa-history"></i>&nbsp&nbspActivity log</a>

            </div>


            <div class="details-settings">
                <h2>Details</h2>
                <hr>
                <div class="details">
                    <!-- username-container -->
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
                    
                        <form action="/User/updateUsername" method="post" class="update-form" id="usernameupdater">
                            <div class="input-container">
                                <label for="text" class="edit-coontainer">Enter new username:</label>
                                <input type="text" id="usernameinput" class="form-ctrl" placeholder="Enter new username" name="username" required><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white" onclick=" updateField('username','usernameupdater')">Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick="showEddite('usernameupdater')">Cancel</button>
                                </div>
                            </div>
                        </form>
                   




                    <!-- Mobile-number-container -->
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
                    
                        <form action="/User/updateContactNumber" method="post" class="update-form" id="mobileupdater">
                            <div class="input-container">

                                <label for="text" class="form-item label">Enter new mobile:</label>
                                <input type="tel" placeholder="Enter new mobile" class="form-ctrl"  name="contact_number" onkeyup="checkTelephone(this.value)" required><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white mobile-submit-btn" onclick=" updateField('mobile','mobileupdater')">Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick=" showEddite('mobileupdater')">Cancel</button>
                                </div>
                            </div>
                        </form>
                



                </div>




            </div>
            <div class="login-settings">
                <h2>Login-info</h2>
                <hr>

                <div class="login-info">


                    <!-- email-container -->
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
              
                        <form action="/User/updateEmail" method="post" class="update-form" id="emailupdater">
                            <div class="input-container">
                                <label for="text">Enter new email:</label>
                                <span class="input-error email-error error" style="color :red; font-size :0.7rem; "><?php if (isset($_GET["invaliderr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['invaliderr']; ?></span>
                                <input type="email" class="form-ctrl" placeholder="Enter new email" name="email" onkeyup="checkMail(this.value)" required /><br>

                                <div class="intro-update-btn">
                                    <button type="submit" id="email-submit-btn" class="btn bg-green clr-white" onclick=" updateField('email','emailupdater')" <?php if (isset($_GET['invaliderr'])) {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick=" showEddite('emailupdater')">Cancel</button>
                                </div>
                            </div>
                        </form>
              


                    <!-- Password container -->
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

                        <form action="/User/updatePassword" method="post" class="update-form" id="passwordupdater">
                            <div class="input-container">

                                <label for="password" class="form-item label">Enter current password:</label>
                                <span class="input-error" style="color :red ; font-size :0.7rem;"><?php if (isset($_GET["currentpassworderr"])) echo "<i class='fas fa-exclamation-circle'></i> &nbsp" . $_GET['currentpassworderr']; ?></span>
                                <input type="password" class="form-ctrl" placeholder="Enter current password" id="passwordinputold" name="current_password" onkeyup="clearCurrentpasswordError()"><br>


                                <label for="password" class="form-item label">Enter new password: </label>
                                <input type="password" class="form-ctrl password-error" placeholder="Enter new password" id="new-password" name="new_password"><br>


                                <label for="password" class="form-item label">Confirm password:</label>
                                <span class="error" id="confirm-password-error"></span>
                                <input type="password" class="form-ctrl" placeholder="Enter confirm password" id="confirm-password" name="password" onkeyup="passwordMatch(this.value)"><br>



                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white password-submit-btn" onclick="showEddite('passwordupdater')" <?php if (isset($_GET['currentpassworderr'])) { echo "disabled"; } ?>>Update</button>
                                    <button type="button" class="btn bg-red border-red clr-white" onclick="showEddite('passwordupdater')">Cancel</button>
                                </div>
                            </div>
                        </form>
                    


                </div>




            </div>


        </div>

    </div>




    </div>

    <?php include "complaint.php" ?>

    <?php include "footer.php"; ?>



     <!-- Link Script for change profile picture-->
    <script src="../Public/assets/js/reguserProfilePic.js"></script>

    <!-- Link Script for display input validation errors-->
    <script src="/Public/assets/js/input_validation.js"></script>

    <script>
        // Invalid email error
        <?php if (isset($_GET["invaliderr"])) echo "showEddite('emailupdater');" ?>

        // Current password incorrect error
        <?php if (isset($_GET["currentpassworderr"])) echo "showEddite('passwordupdater');" ?>

        // Clear current password input  field                                                                                                                            
        function clearCurrentpasswordError() {
            let current_password_error = document.querySelector(".current-password-error");
            current_password_error.innerHTML = "";


        }

        // Check mobile input and disable/enable submit buttons
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


        // function checkMail(email) {

        //         $.ajax({
        //             url: "/User/checkEmailAvailable",
        //             type: "post",
        //             dataType: 'json',
        //             data: {
        //                 email: email
        //             },
        //             success: function(result) {

        //                 if (result.taken == true) {
        //                     document.getElementById('email-submit-btn').disabled = true;
        //                 } else {
        //                     document.getElementById('email-submit-btn').disabled = false;
        //                 }
        //             }
        //         });
        // } 



        // Edit form toggle function
        function showEddite(elementId) {
            // alert()
            document.getElementById(elementId).classList.toggle("unhide");

        }

        // Update detail container when update by user
        function updateField(elementId, containerID) {

            document.getElementById(elementId).innerText = document.getElementById(elementId + 'input').value;
            document.getElementById(containerID).classList.toggle("hide");

        }

        // Match new password and confirm password and disable/enable submit buttons
        function passwordMatch(confirm_password) {

            const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let new_password = document.getElementById('new-password');
            let alert = document.getElementById("confirm-password-error");

            if (new_password.value == confirm_password && pattern.test(new_password.value)) {

                alert.innerHTML = "<i class='fas fa-exclamation-circle'></i> &nbsp Password matched";
                alert.style.color = "green";
                alert.style.fontSize = "0.7rem";
                document.querySelector('.password-submit-btn').disabled = false;

            } else {
                document.querySelector('.password-submit-btn ').disabled = true;
                alert.innerHTML = "<i class='fas fa-exclamation-circle'></i> &nbsp Still not matched with new passowrd";
                alert.style.color = "red";
                alert.style.fontSize = "0.7rem";
            }
        }
    </script>

</body>


</html>