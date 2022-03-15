<!DOCTYPE html>
<html>
    <head>
        <title>
            CommunityRetreat
        </title>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../Public/assets/newstyles.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href= "../Public/assets/style/fontawesome.min.css">
            <link rel="stylesheet" href="../Public/assets/style/historystyle.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        

    </head>
    <body>
        <?php include"nav.php"; ?>
        <h1 id="topic">
            Activity Log
        </h1>
        
       <div class="table-container">
           
            <table class="event-table" id = "table">
                <thead>
                    <tr class="thead">
                        <th>Date</th>
                        <th>Activity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">

                <?php 
                    if(isset($activities)){
                        foreach($activities as $activity){?>
                            <tr>
                                <td>
                                    <div class="data-label">Date</div>
                                    <div class="data date"><?=date("D M j  Y",strtotime($activity['time_stamp']));?></div>
                                </td>
                                <td>
                                    <div class="data-label">Activity</div>
                                    <div class="data">

                                    <?php if($activity['event_id'] != NULL){?>
                                        <a href="/Event/view?page=about&&event_id=<?=$activity['event_id']?>"><?=$activity['activity']?></a>
                                    <?php } else{?>
                                        <p><?=$activity['activity']?></p>
                                    <?php } ?>

                                    </div>
                                </td>
                                <td class="action-div">
                                    <div class="action"></div>
                                    <button class="btn bg-red clr-white border-red "  onclick="popupLoad('<?=$activity['time_stamp']?>')">Remove</button>
                                </td>
                            </tr>
                <?php   } 
                    } else{ 
                ?> 
                            <tr id="data-row">
                                <td  style="height:10rem;" colspan = 3 >
                                    <h2   style=" text-align:center;padding-top:0.5rem;color: lightslategray;">No Activities Yet</h2>
                                </td>
                            </tr>
                <?php } ?>

                </tbody>
                  
            </table>
        
       </div>
       <div class="flex-row flex-center ">
            <ul class="pagination">
                <li><a href="/User/viewActivityLog?pageno=1"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '';
                                } else {
                                    echo "/User/viewActivityLog?pageno=" . ($pageno - 1);
                                } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
                </li>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "/User/viewActivityLog?pageno=" . ($pageno + 1);
                                } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
                </li>
                <li><a href="/User/viewActivityLog?pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </div>
       <div class="pop-up-container" id="popup">
           <form action="/User/removeActivity" method="post" class="pop-up">
                <h3>Are you sure ?</h3>
               <div class="confirm-buttons"> 
                    <input type="hidden" id="activity-id"name="time_stamp" ></input>  
                    <button  class= "btn bg-green clr-white border-green" id="confirm-btn" type="submit" >Yes</button>
                    <button  class= "btn bg-red clr-white border-red" onclick="popupHide()" type="button">No</button>
               </div>
           </form>
       </div>
    


    </body>
    <?php include "footer.php" ?>
    <script>
        function popupLoad(index){
            var activity = document.getElementById("activity-id");
            var popup = document.getElementById("popup");
            popup.classList.toggle("pop-up-load");
            activity.setAttribute("value", index);   
            
        }

        function popupHide(){
            var popup = document.getElementById("popup");
            popup.classList.toggle("pop-up-load");

        }
    </script>

</html>