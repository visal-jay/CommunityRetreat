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
            <script defer src="../Public/assets/js/activity_log.js"></script>
        

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
       <div class="pop-up-container" id="popup">
           <div class="pop-up">
                <h3>Are you sure ?</h3>
               <div class="confirm-buttons">   
                    <button  class= "btn bg-green clr-white border-green" id="confirm-btn" >Yes</button>
                    <button  class= "btn bg-red clr-white border-red" onclick="popupHide()">No</button>
               </div>
           </div>
       </div>
    


    </body>
    <?php include "footer.php" ?>
    <script>
        function popupLoad(index){
            var popup = document.getElementById("popup");
            popup.classList.toggle("pop-up-load");
            var time_stamp = table_data[index].date;
            console.log(index);
            console.log(time_stamp);
            document.getElementById('confirm-btn').addEventListener('click', () =>{
                table_data.splice(index,1);
                document.getElementById("table-body").innerHTML = "";
                table_data.map(addDataRow);
                $.ajax({
                        url: "/User/removeActivity",
                        type: "post",
                        dataType: 'json',
                        data: {
                            time_stamp: time_stamp
                        }
                
                    });
                popup.classList.toggle("pop-up-load")
            });
            ;
            
        }

        function popupHide(){
            var popup = document.getElementById("popup");
            popup.classList.toggle("pop-up-load");

        }
    </script>

</html>