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
        .eventsearchbar{
            padding:2em 0 ;
            display:flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
    
        }
        #event-search{
            background-image: url('/css/searchicon.png');
        }

        .table-container{
            margin: 10px auto;
            min-height: 100%;
        }
        .table{
            width: 50%;
            margin: auto;
        }
        .table th{
            
            font-weight: 900;
            letter-spacing: 0.35px;
            text-align: center; 
            padding: 1rem;
            
        }

        .table td{  
            letter-spacing: 0.35px;
            font-weight: normal;
            padding: 0.5rem;
            text-align: center;
            border-collapse: none;
        }

    </style>
  



</head>
<?php include "nav.php" ?>

<body onload="renderDetails()">

    <h1 id="topic">
        Administration
    </h1>
    
    <form action="/action_page.html"  class="eventsearchbar" style="height:fit-content">
        <input type="search" id="event-search" class="form-ctrl" placeholder="Search event" onkeyup="searchEvent()">
    </form>
    
    <div class="table-container">
        <table class="table" >
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Organization</th>
                    <th>User role</th>
                </tr>
            </thead>
            <tbody id="table-body">

            </tbody>   
        </table>
    </div>
    
    
</body>
<script>
    function renderDetails(){
        $.ajax({
        url: "/RegisteredUser/viewAdministration",
        type: "post",
        success : function(results){
            result = JSON.parse(results);
            console.log(result[1]);
            let tbody = document.getElementById("table-body");
                for(let i=0 ; i<result.length ;i++){
                    if(result[i].moderator_flag == 1 && result[i].treasurer_flag == 0){
                        tbody.innerHTML += `<tr id="data-row">
                                            <td id="event-name-td"><a class="clr-black" href='/Event/view?page=about&&event_id=${result[i].event_id}'>${result[i].event_name}</a></td>
                                            <td>${result[i].organisation_username}</td>
                                            <td>Moderator</td>
                                        </tr>`;

                    }
                    else if(result[i].moderator_flag == 0 && result[i].treasurer_flag == 1){
                        tbody.innerHTML += `<tr id="data-row">
                                            <td id="event-name-td"><a class="clr-black" href='/Event/view?page=about&&event_id=${result[i].event_id}'>${result[i].event_name}</a></td>
                                            <td>${result[i].organisation_username}</td>
                                            <td>Treasurer</td>
                                        </tr>`;

                    }
                    else if(result[i].moderator_flag == 1 && result[i].treasurer_flag == 1){
                        tbody.innerHTML += `<tr id="data-row">
                                            <td id="event-name-td"><a class="clr-black" href='/Event/view?page=about&&event_id=${result[i].event_id}'>${result[i].event_name}</a></td>
                                            <td>${result[i].organisation_username}</td>
                                            <td>Moderator&nbsp/&nbspTreasurer</td>
                                        </tr>`;

                    }
                }

            }

        });
    }

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