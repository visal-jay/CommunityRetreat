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
    <link rel="stylesheet" href="../Public/assets/style/fontawesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        *{
            margin: 0%;
            padding: 0%;
            box-sizing: border-box;
        }

        #topic{

            text-align:center;
            padding-top:1rem;
            color: #16c79a;
    
        }
 
        #event-search{
            background-image: url('/css/searchicon.png');
            width: 40%;
        }

        .table-container{
            margin: 10px auto 50px;

        }
        .table{
            position: absoulte;
            z-index: 2;
            border-collapse: collapse;
            border-spacing: 0;
            border-radius: 12px 12px 0 0;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(32,32,32,.3);
            width: 50%;
            margin: auto;
        }
        th{
            
            font-weight: 900;
            text-align: left; 
            padding: 12px 15px;
            text-transform: uppercase ;
            color: white;
            background: #03142d;
       
        }

         td{  
            letter-spacing: 0.35px;
            font-weight: normal;
            padding: 12px 15px;
            width: 200px;
            border-collapse: none;
            text-align: left;
        }
        tr:nth-child(odd){
            background-color: #eeee;
        }
        tr:hover:not(.thead){
            transform: scale(1.03);
            transition-duration: 1s;
        }
        a{
            text-decoration: none;
        }
        a:hover{
            text-decoration: underline;
        }
        .searchbar-container{
            margin: 30px auto 20px auto;
            padding:1em;
            display:flex;
            justify-content: space-evenly;
            flex-direction: column;
            align-items: center;
            width: 50%;
        }
        @media screen and (max-width: 700px) {
            .searchbar-container{
                width: 70%;
            }
            #event-search{
                width: 50%;
                color:aliceblue;
            }
            .table{
                width: 70%;
            }
        }
 
        @media screen and (max-width:500px) {
            .searchbar-container{
                width: 90%;
                background: #03142d;
                color: white;
                border-radius: 12px;
                box-shadow: 0 2px 12px rgba(32,32,32,.3);
            }
            #event-search{
                width: 60%;
            }
            .table thead{
                display: none;
            }

            .table, .table tbody, .table tr{
            
                display: block;
                width: 95%;
                box-shadow: none;
                margin: auto;
            }
            .table td{
                display: block;
                padding-left: 45%;
                text-align: left;
                position: relative;
                width: 100%;
            }

            .table tr{
                display: block;
                margin-bottom: 15px;
                border-radius: 8px;
                border-top: 3px solid #16c79a;
                background: transparent;
                box-shadow: 0 2px 12px rgba(32,32,32,.3);

            }
            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-size: 15px;
                font-weight: bold;
                text-align: left;
             }

        }

        @media screen and (max-width: 350px) {
            .searchbar-container{
                width: 95%;
            }
            #event-search{
                width: 70%;
            }
            .table td{
                width: 100%;
                font-size: 13px;
            }
            
        }


    </style>
  



</head>
<?php include "nav.php" ?>

<body>

    <h1 id="topic">
        Administration
    </h1>
    <div class="searchbar-container">
            <h3 style="margin: 10px 0 10px 0;text-align:center;"><i class="fas fa-search "></i>&nbsp&nbspSearch your Administrations</h3>
            <input type="search" id="event-search" class="form-ctrl" placeholder="Search event" onkeyup="searchEvent()">
    </div>
    
    <div class="table-container">
        <table class="table" >
            <thead >
                <tr class="thead">
                    <th>Event</th>
                    <th>Organization</th>
                    <th>User role</th>
                </tr>                
            </thead>
            <tbody id="table-body" >
                <?php if(isset($administrations)){
                    foreach($administrations as $administration){ 
                        if( $administration['moderator_flag'] == 1 && $administration['treasurer_flag'] == 0){
                ?>
                            <tr id="data-row">
                                <td id="event-name-td" data-label="EVENT"><a class="clr-black" href='/Event/view?page=about&&event_id=<?=$administration['event_id']?>'><?=$administration['event_name']?></a></td>
                                <td data-label="ORGANIZATION"><?=$administration['organisation_username']?></td>
                                <td data-label="USER ROLE">Moderator</td>
                            </tr>
                <?php   } elseif($administration['moderator_flag'] == 0 && $administration['treasurer_flag'] == 1){
                ?>
                            <tr id="data-row">
                                <td id="event-name-td" data-label="EVENT"><a class="clr-black" href='/Event/view?page=about&&event_id=<?=$administration['event_id']?>'><?=$administration['event_name']?></a></td>
                                <td data-label="ORGANIZATION"><?=$administration['organisation_username']?></td>
                                <td data-label="USER ROLE">Treasurer</td>
                            </tr>
                <?php   } elseif($administration['moderator_flag'] == 1 && $administration['treasurer_flag'] == 1){?>
                            <tr id="data-row">
                                <td id="event-name-td" data-label="EVENT"><a class="clr-black" href='/Event/view?page=about&&event_id=<?=$administration['event_id']?>'><?=$administration['event_name']?></a></td>
                                <td data-label="ORGANIZATION"><?=$administration['organisation_username']?></td>
                                <td data-label="USER ROLE">Moderator&nbsp/&nbspTreasurer</td>
                            </tr>
                    <?php } 
                    }
                }else{ ?>
                         <tr id="data-row">
                             <td  style="height:10rem;" colspan = 3 >
                                <h2   style=" text-align:center;padding-top:0.5rem;color: lightslategray;">No Administrations Yet</h2>
                             </td>
                        </tr>

                <?php }
                ?>

            </tbody>   
        </table>
       
   
    </div>
    <div class="flex-row flex-center ">
            <ul class="pagination">
                <li><a href="/RegisteredUser/administratored?pageno=1"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '';
                                } else {
                                    echo "/RegisteredUser/administratored?pageno=" . ($pageno - 1);
                                } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
                </li>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "/RegisteredUser/administratored?pageno=" . ($pageno + 1);
                                } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
                </li>
                <li><a href="/RegisteredUser/administratored?pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </div>
 
    
</body>
<script>
   
    function searchEvent(){
        var input = document.getElementById("event-search");
        var filter = input.value.toUpperCase();
        var tbody = document.getElementById("table-body");
        var row =  tbody.getElementsByTagName("tr");
        for (let i = 0; i < row.length; i++){
           
            var td =  row[i].getElementsByTagName("td")[0];
            var a = td.getElementsByTagName("a")[0];
            var txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                row[i].style.display = "";
            } else {
                row[i].style.display = "none";
            }
        }

        
    }
    
</script>
<?php include "footer.php" ?>

</html>