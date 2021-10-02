
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="/Public/assets/newstyles.css"> -->
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>

    <style>
        .main-footer{
            position: relative;
            background-color: #03142d;
            height:10rem;
            display: flex;
            justify-content:center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
            bottom: 0%;
            
        }
        .footer-content-container{
            color: #16c79a;
            width: 50%;
            display: flex;
            justify-content:space-between;
        }
        .footer-content{
            cursor: pointer;
        }
        .footer-content:hover{
            opacity: 0.3;
        }
        .feedback-container{
            width: 100%;
            min-height:100vh;
            position: -webkit-sticky;
            position: fixed;
            z-index: 100;
            top:0%;
            left:0%;
            display: flex;
            justify-content: center;
            display:none;
            padding-top: 120px;
            backdrop-filter: blur(3px);
        }
 
        .unhide
        {
            display: flex;
        }
        .feedback-form{
            width: 30%;
            height: 400px;
            display: flex;
            margin: auto;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            border-radius: 8px;
            box-shadow: 0px 0px 0px 1px silver;
            border-top: 3px solid #16c79a;
            padding: 0 2rem;
            position: absolute;
            background-color: white;
        }
        .feedback-textarea{

            resize:none;
            padding: 0.3em 0.5em;
            border: 1px solid #ccc;
            font-size: 1rem;
            background: transparent;
            border-radius: 6px;
            font-family: inherit;
            margin-bottom: 0.8rem;
        }
        .feedback-textarea:focus{
            box-shadow: 0px 0px 0px 1px #16c79a;
            border-color: #16c79a;
        }

        .confirm-buttons{
            width: 80%;
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
        }
        .overflow{
            overflow: hidden;
        }
        .logo img{
            height: 40px;
            color: #16c79a;
        }
        #feedback-form{
            width: 100%;
            height: 100%;
        }

        @media screen and (max-width: 1000px){
            .footer-content-container{
                width: 60%;
            }
            .feedback-form{
                width: 40%;
            }
            .feedback-form > .confirm-buttons{
                width: 85%;
            }
        }
        @media screen and (max-width: 800px){
            .footer-content-container{
                width: 70%;
            }
            .feedback-form{
                width: 50%;
            }
        }
        
        @media screen and (max-width: 700px){
            .footer-content-container{
                width: 80%;
            }
        }
        
        @media screen and (max-width: 600px){
            
            footer{
                font-size: 13px;
                height: 6rem;
            }
            .footer-content-container{
                width: 90%;
                padding: 1rem 0rem 0rem;
                
            }
            .feedback-form{
                width: 65%;
            }
            .feedback-form textarea{
                width: 18rem;
            }
            .feedback-form > .confirm-buttons{
                width: 88%;
            }

        }
        @media screen and (max-width: 420px){
            footer{
                font-size: 12px;
                height: 5rem;
            }
            .footer-content{
                width: 100%
            }
            .main-footer-content{
                padding: 0.1rem;
            }
            .feedback-form{
             
                height: 350px;
                font-size: 13px;
            }
            .feedback-form textarea{
                width: 15rem;
            }
            .feedback-form > .confirm-buttons{
                width: 95%;
               

            }

        } 
        @media screen and (max-width: 340px){
            footer{
                font-size: 11px;
                
            }
            .feedback-form{
             
                height: 330px;
                width: 70%;
                font-size: 12.5px;
            }
            .feedback-form textarea{
                width: 14rem;
            }
             .confirm-buttons button{
                
                font-size: 0.8rem;
            }

        }


    </style>
</head>


<body>

    <div class="feedback-container">

        <!-- Feedback form -->
        <form action="/Systemfeedback/getSystemFeedbacks" method="post" class="feedback-form"> 
        
                    <h2>Send us some feedback !</h2>
                    <p>Do you have a suggestion or found some bug? Let us know in the field below.</p>
                <textarea cols="40" rows="8" placeholder= "Describe here" class="feedback-textarea form-ctrl"  name="feedback" required></textarea>
                <div class="confirm-buttons">
                    
                        <button   type="submit" class= "btn bg-green clr-white border-green">Submit</button>
                        <button type="button" onclick="popup()" class= "btn bg-red clr-white border-red">Cancel</button>
                </div>
        
        </form>
    </div>

    <footer class="main-footer">
        <?php if (!$admin) { ?>
            <div class="footer-content-container">
                <div class="footer-main-content">
                    <p class="footer-content">About Us</p>
                </div>
                <div class="footer-main-content">
                    <p class="footer-content" onclick="popup()">Feedback Us</p>
                </div>
                <div class="footer-main-content">
                    <p class="footer-content">Contact Us</p>
                </div>
                <div class="footer-main-content">
                    <p class="footer-content">Terms & conditions</p>
                </div>
            </div>
            <?php }?>
        <div class= "copyright">
                <p style="color:gray; margin: 1.5rem 0;"><i class="far fa-copyright"></i>&nbsp2021 Community Retreat, All Right Reserved.</p>
        </div>
        <a class="logo ">
            <img src="/Public/assets/visal logo.png ">
        </a>
        
        
    </footer>
     
</body>

<script>
  
  function popup(){
        let feedback_form = document.querySelector(".feedback-container");
        let body =document.getElementsByTagName("body")[0];
        body.classList.toggle("overflow");
        feedback_form.classList.toggle("unhide");
  }



</script>
<script src="/Public/assets/js/input_validation.js"></script>

</html>