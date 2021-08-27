<?php if(!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Public/assets/style/newstyles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href= "../Public/assets/style/profilestyle.css">
        <link rel="stylesheet" href= "../Public/assets/style/fontawesome.min.css">
        <title>Registrationuser profile</title>
    </head>
    <body>
        <?php 
            $_SESSION["uid"] = "REG0000022";
            
        ?>
      
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
                <button class="btn btn-solid" id="near-me"><i class="fas fa-map-marker-alt" ></i>&nbsp;Near me</button>
                <form action="/action_page.html" class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl" placeholder="Search" >
                    <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </form>
                <a class="nav-link margin-side-md" href="/view/adoption_listing.php ">About</a>
                <a class="nav-link margin-side-md" href="clender.html">Calender</a>
                <a class="nav-link margin-side-md" href="history.html">History</a>
            </nav>
 
            <a class="btn btn-solid" href="profile.php" style="font-size:1rem "><i class="fa fa-user "> </i>Me </a>

            <button class="btn more-btn " onclick="document.querySelector( '.main-nav').classList.toggle( 'shown') ">
                <i class="fa fa-bars "></i>
            </button>

        </header>
        
    
        <form action="/RegisteredUser/updateProfile" method="post" id="edit-user-profile-form" >
            <div class="profilecontainer">
                  <div class="profilecontainer-top">
                        <div class="profilepic-pic-div">
                            <img src="../Public/assets/User-icon.png" id="dp" >
                            <input type= "file" id="file" >
                            <label for="file" id="uploadbtn">upload photo</label>
        
                        </div>
                        
                            <div class="aboutme-container">
                                <div class="edit-intro-btn">
                                    <h2  id="name"><?= $username; ?></h2>
                                </div>
                                <br><h3 id="livefrom"><i class="fas fa-map-marker-alt" id="marker"></i><?= $city; ?>,<?= $country; ?></h3>
                                
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
                                            <h3 id="username"><?= $username?></h3>
            
                                        </div>
                                        <div class="username-change-btn">
                                            <button class="btn btn-clr" type="button" onclick="showEddite('usernameupdater')"><i class="fas fa-pen fa-1x" id="edit-icon"></i></button>
                                        </div>
                                    </div>
                                    <div class="update-form" id="usernameupdater">
                                        <div class="input-container">
                                            <label for="text" class="edit-coontainer">Enter new username:</label>
                                            <input type="text" id="usernameinput" placeholder="Enter new username" name="username" ><br>
            
                                            <div class="intro-update-btn">
                                                <button type="submit" class="btn bg-green clr-white" onclick=" updateField('username','usernameupdater')">Update</button>
                                                <button type="button" class="btn bg-red border-red clr-white" onclick="showEddite('usernameupdater')">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                  

                                    <div class="location-container">
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt fa-2x" id="marker"></i>
                                            <label  for="location" id="mobile-label">Location</label>
                                        </div>
                                       
                                        <div class="location" id="location">
                                            <h3><?= $city ?>,<?= $country ?></h3>
 
                                        </div>
                                        <div class="location-change-btn">
                                            <button class="btn btn-clr" type="button" onclick=" showEddite('locationupdater')"><i class= "fas fa-pen fa-1x" id="edit-icon"></i></button>
                                        </div>
                                       
                                    </div>


                                    <div class="update-form" id="locationupdater">
                                        <div class="input-container">
                                            
                                            <label for="text">Country:</label>
                                            <input type="text" id="countryinput" placeholder="Enter the country" name="country" ><br>
                    
                    
                                            <label for="text">Town:</label>
                                            <input type="text" id="towninput" placeholder="Enter the town" name="city" ><br>
                                        </div>
                                        <div class="intro-update-btn">
                                            <button type="submit" class="btn bg-green clr-white" onclick=" updateField('name','livefrom','towninput','countryinput','nameupdater')">Update</button>
                                            <button type="button" class="btn bg-red border-red clr-white" onclick="showEddite('locationupdater')">Cancel</button>
                                        </div>

                                    </div>
                                

                                    <div class="mobile-container">
                                        <div class="mobile-icon">
                                            <i class="far fa-mobile-alt fa-2x" id="mobi"></i>
                                            <label  for="mobi" id="mobile-label">Mobile</label>
                                        </div>
                                       
                                        <div class="mobile" id="mobile">
                                            <h3><?= $contact_number ?></h3>
 
                                        </div>
                                        <div class="mobile-change-btn">
                                            <button class="btn btn-clr" type="button" onclick=" showEddite('mobileupdater')"><i class= "fas fa-pen fa-1x" id="edit-icon"></i></button>
                                        </div>
                                       
                                    </div>
                                    <div class="update-form" id="mobileupdater">
                                        <div class="input-container">
                                        
                                            <label for="text" class = "form-item label" >Enter new mobile:</label>
                                            <input type= "text"  placeholder = "Enter new mobile" id="mobileinput" name="contact_number" ><br>
                                        
                                            <div class="intro-update-btn">
                                                <button type= "submit" class="btn bg-green clr-white"  onclick=" updateField('mobile','mobileupdater')" >Update</button>
                                                <button type= "button" class="btn bg-red border-red clr-white" onclick=" showEddite('mobileupdater')">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                              
                                         
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
                                                <button class="btn btn-clr" type="button" onclick=" showEddite('emailupdater')"><i class= "fas fa-pen fa-1x" id="edit-icon"></i></button>
                                            </div>
                                        </div>
                                    
                                        <div class="update-form" id="emailupdater">
                                            <div class="input-container">
                                                <label for="text"  >Enter new email:</label>
                                                <input type= "text" placeholder = "Enter new email" id ="emailinput" name="email" ><br>
                                            
                                                <div class="intro-update-btn">
                                                    <button type= "submit" class="btn bg-green clr-white"  onclick=" updateField('email','emailupdater')">Update</button>
                                                    <button type="button" class="btn bg-red border-red clr-white" onclick=" showEddite('emailupdater')" >Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    

                                      
                                        <div class="password-container">
                                            <div class="password-icon">
                                                <i class="fa fa-key fa-2x clr-gray" id="pass"></i>
                                                <label   id="password-label">Password</label>
                                            </div>
                                        
                                            <div class="password">
                                                <input type= "password"    id="password"  value="<?= $password; ?>" disabled><br>
                                            </div>
                                            <div class="password-change-btn">
                                                    <button class="btn btn-clr" type="button" onclick="showEddite('passwordupdater')"><i class= "fas fa-pen fa-1x" id="edit-icon"></i></button>
                                            </div>
                                            
                                        </div>
                                        <div class="update-form"  id="passwordupdater">
                                            <div class="input-container">
                                            
                                                <label for="password" class = "form-item label" >Enter current password:</label>
                                                <input type= "password"  placeholder = "Enter current password:" id="passwordinputold"   ><br>
                                        
                                                <label for="password" class = "form-item label" >Enter new password: </label>
                                                <input type= "password" placeholder = "Enter new password:" id = "passwordinputnew"  ><br>
                                                
                                                
                                        
                                                <label for="password" class = "form-item label" >Confirm password:</label>
                                                <input type= "password"  placeholder = "Enter current password:" id="passwordinput" name="password" >
                                                <span id="alert"></span><br>
                                                <p id="alert"><?php echo $_GET["passworderr"]; ?></p>
                                                
                                            
                                                <div class="intro-update-btn">
                                                    <button type= "submit" class="btn bg-green clr-white"  onclick="passwordmatch('passwordinputnew','passwordinput','alert','passwordupdater')" >Update</button>
                                                    <button type= "button" class="btn bg-red border-red clr-white"  onclick="showEddite('passwordupdater')">Cancel</button>
                                                </div>
                                            </div>
                                        </div> 

            </form>   
                                    </div>
                                
                            
                    
                        
                        </div>
                        
                        
                  </div>
                 
            </div>

        
   

        </div>

  
     
   

    <script src = "../Public/assets/js/app.js" ></script>

    <script>
        function showEddite(elementId){
            // alert()
            document.getElementById(elementId).classList.toggle("unhide");
        }
        function updateField(elementId,containerID){
            
            document.getElementById(elementId).innerText = document.getElementById(elementId+'input').value;
            document.getElementById(containerID).classList.toggle("hide");
            
        }
        function passwordmatch(elementId1,elementId2,spanId,containerID){
           if(document.getElementById(elementId1).value != document.getElementById(elementId2).value){
                let action = document.getElementById(spanId);
                document.getElementById(containerID).appendChild(action);
                document.getElementById(spanId).innerText ="Does not match!";
                return 0;
           }
          
            document.getElementById(spanId).innertext = "";
            document.getElementById('password').value = document.getElementById('passwordinput').value;
            document.getElementById(containerID).classList.toggle("hide");
            

        }
       
    </script>
    </body>
</html>
