<!DOCTYPE html>
<html>
    <head>
        <title>
            index
        </title>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../Public/assets/newstyles.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href= "../Public/assets/style/fontawesome.min.css">
            <link rel="stylesheet" href="../Public/assets/style/historystyle.css">
            <script defer src="../Public/assets/js/main.js"></script>
        

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
                <button class="btn btn-solid" id="near-me"><i class="fas fa-map-marker-alt" ></i>&nbsp;Near me</button>
                <form action="/action_page.html" class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl" placeholder="Search" >
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
        <h1 id="topic">
            Activity Log
        </h1>
        
       <div class="table-container">
           
            <table class="event-table" id = "table">
                <thead>
                    <tr>
                        <th>Event name</th>
                        <th>Date</th>
                        <th>Activity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">

                </tbody>
                  
            </table>
        
                

            
            
              
            </div>
        
    </div>
       <div class="pop-up-container" id="popup">
           <div class="pop-up">
                <h3>Are you sure ?</h3>
               <div class="confirm-buttons">
                   
                    <button onclick = "onDelete('')" class= "btn bg-green clr-white border-green">Yes</button>
                    <button onclick="popupLoad()" class= "btn bg-red clr-white border-red">No</button>
               </div>
           </div>
       </div>
    <script>
        const tableEl = document.querySelector('table');
        function popupLoad(){
            var popup = document.getElementById("popup");
            popup.classList.toggle("pop-up-load");
        }
 
    </script>


    </body>

</html>