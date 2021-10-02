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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script defer src="../Public/assets/js/main.js"></script>
        

    </head>
    <body>
        <?php include"nav.php"; ?>
        <h1 id="topic">
            Activity Log
        </h1>
        
       <div class="table-container">
           
            <table class="event-table" id = "table">
                <thead>
                    <tr>
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
    <?php include "footer.php" ?>

</html>