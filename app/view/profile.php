<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../Public/assets/style/profilestyle.css">
    <link rel="stylesheet" href="../Public/assets/style/fontawesome.min.css">
    <title>Registrationuser profile</title>
</head>

<body>
    
        <header class="header">
            <a class=" logo ">
                <img src="../Public/assets/visal logo.png">
            </a>
            <nav class="main-nav ">
                <div class="flex justify-between " style="width:100% ">
                    <button class="btn btn-link more-btn " onclick="document.querySelector( '.main-nav').classList.toggle( 'shown') ">
                        <i class="fa fa-times fa-2x"></i>
                    </button>
                </div>
                <button class="btn btn-solid" id="near-me"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
                <form action="/action_page.html" class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl" placeholder="Search">
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">About</a>
                <a class="nav-link margin-side-md" href="# ">Calender</a>
                <a class="nav-link margin-side-md" href="# ">History</a>
            </nav>

            <a class="btn btn-solid" href="profile.html" style="font-size:1rem "><i class="fa fa-user "> </i>Me </a>

            <button class="btn more-btn " onclick="document.querySelector( '.main-nav').classList.toggle( 'shown') ">
                <i class="fa fa-bars "></i>
            </button>

        </header>

        <div class="profilecontainer">
            <div class="profilecontainer-top">
                <div class="profilepic-pic-div">
                    <img src="../Public/assets/User-icon.png" id="dp">
                    <input type="file" id="file">
                    <label for="file" id="uploadbtn">upload photo</label>
                </div>

                <div class="aboutme-container">
                    <div class="edit-intro-btn">
                        <h2 id="name">Iroshan Umayangana jayathilaaka</h2>
                    </div>
                    <br>
                    <h3 id="livefrom"><i class="fas fa-map-marker-alt" id="marker"></i> Matara,Sri Lanka</h3>
                    <button class="btn btn-icon " onclick="showEddite('nameupdater')">Edit bio</button>
                </div>

                <div class="name-update-form" id="nameupdater">
                    <div class="input-container">
                        <label for="text">Enter your name:</label>
                        <input type="text" id="nameinput" placeholder="Enter the name"><br>


                        <label for="text">Country:</label>
                        <input type="text" id="countryinput" placeholder="Enter the country"><br>


                        <label for="text">Town:</label>
                        <input type="text" id="towninput" placeholder="Enter the town"><br>
                    </div>
                    <div class="intro-update-btn">
                        <button type="submit" class="btn bg-green clr-white" onclick="changeName('name','livefrom','towninput','countryinput','nameupdater')">Update</button>
                        <button type="submit" class="btn bg-red border-red clr-white" onclick="showEddite('nameupdater')">Cancel</button>
                    </div>

                </div>



                <div class="contact-settings">
                    <h2>Contact-info</h2>
                    <hr>

                    <div class="contact-info">

                        <div class="email-container">
                            <div class="email-icon">
                                <i class="far fa-envelope fa-2x" id="envelope"></i>
                                <label for="envelope" id="envelope-label">Email</label>
                            </div>

                            <div class="email">
                                <h3 id="email">2019cs031@gmail.com</h3>
                            </div>
                            <div class="email-change-btn">
                                <button class="btn btn-clr" onclick=" showEddite('emailupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                            </div>
                        </div>

                        <div class="name-update-form" id="emailupdater">
                            <div class="input-container">
                                <label for="text">Enter new email:</label>
                                <input type="text" placeholder="Enter new email" id="emailinput"><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white" onclick="changeUserName('email','emailupdater')">Update</button>
                                    <button type="submit" class="btn bg-red border-red clr-white" onclick=" showEddite('emailupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div class="mobile-container">
                            <div class="mobile-icon">
                                <i class="far fa-mobile-alt fa-2x" id="mobi"></i>
                                <label for="mobi" id="mobile-label">Mobile</label>
                            </div>

                            <div class="mobile" id="mobile">
                                <h3>+94703414038</h3>

                            </div>
                            <div class="mobile-change-btn">
                                <button class="btn btn-clr" onclick=" showEddite('mobileupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                            </div>

                        </div>
                        <div class="name-update-form" id="mobileupdater">
                            <div class="input-container">

                                <label for="text" class="form-item label">Enter new mobile:</label>
                                <input type="text" placeholder="Enter new mobile" id="mobileinput"><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white" onclick="changeUserName('mobile','mobileupdater')">Update</button>
                                    <button type="submit" class="btn bg-red border-red clr-white" onclick=" showEddite('mobileupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>


                    </div>




                </div>
                <div class="security-settings">
                    <h2>Login-info</h2>
                    <hr>

                    <div class="login-info">

                        <div class="username-container">
                            <div class="username-icon">
                                <i class="fa fa-user-circle fa-2x clr-gray" id="user"></i>
                                <label id="user-label">Username</label>
                            </div>

                            <div class="username">
                                <h3 id="username">2019cs031</h3>

                            </div>
                            <div class="username-change-btn">
                                <button class="btn btn-clr" onclick="showEddite('usernameupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                            </div>
                        </div>
                        <div class="name-update-form" id="usernameupdater">
                            <div class="input-container">
                                <label for="text" class="edit-coontainer">Enter new username:</label>
                                <input type="text" id="usernameinput" placeholder="Enter new username"><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white" onclick="changeUserName('username','usernameupdater')">Update</button>
                                    <button type="submit" class="btn bg-red border-red clr-white" onclick="showEddite('usernameupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <div class="password-container">
                            <div class="password-icon">
                                <i class="fa fa-key fa-2x clr-gray" id="pass"></i>
                                <label id="password-label">Password</label>
                            </div>

                            <div class="password">
                                <input type="password" id="password" disabled><br>
                            </div>
                            <div class="password-change-btn">
                                <button class="btn btn-clr" onclick="showEddite('passwordupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                            </div>

                        </div>
                        <div class="name-update-form" id="passwordupdater">
                            <div class="input-container">
                                <label for="password">Enter current password:</label>
                                <input type="password" class="form-ctrl" placeholder="Enter current password:" id="passwordinputold"><br>

                                <label for="password">Enter new password: </label>
                                <input type="password" class="form-ctrl" placeholder="Enter new password:" id="passwordinputnew"><br>

                                <label for="password">Confirm password:</label>
                                <input type="password" class="form-ctrl" placeholder="Enter current password:" id="passwordinput">
                                <span id="alert"></span><br>

                                <div class="intro-update-btn">
                                    <button type="submit" class="btn bg-green clr-white" onclick="passwordmatch('passwordinputnew','passwordinput','alert','passwordupdater')">Update</button>
                                    <button type="submit" class="btn bg-red border-red clr-white" onclick="showEddite('passwordupdater')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</body>


<script>
    function showEddite(elementId) {
        // alert()
        document.getElementById(elementId).classList.toggle("unhide");
    }

    function changeUserName(elementId, containerID) {
        document.getElementById(elementId).innerText = document.getElementById(elementId + 'input').value;
        document.getElementById(containerID).classList.toggle("hide");

    }

    function passwordmatch(elementId1, elementId2, spanId, containerID) {
        if (document.getElementById(elementId1).value != document.getElementById(elementId2).value) {
            let action = document.getElementById(spanId);
            document.getElementById(spanId).innerText = "Does not match!";
            return false;
        }

        document.getElementById(spanId).innertext = "";
        document.getElementById('password').value = document.getElementById('passwordinput').value;
        document.getElementById(containerID).classList.toggle("hide");


    }

    function changeName(elementId1, elementId2, elementId3, elementId4, containerID) {
        document.getElementById(elementId1).innerText = document.getElementById(elementId1 + 'input').value;
        document.getElementById(elementId2).innerText = document.getElementById(elementId3).value + " , " + document.getElementById(elementId4).value;
        document.getElementById(containerID).classList.toggle("hide");

    }
</script>


</html>