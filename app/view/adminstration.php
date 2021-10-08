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
    <script defer src="../Public/assets/js/admininis.js"></script>
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
    
        }
        .table-container{
            margin: 10px auto;
            min-height: 100%;
        }
        .table{
            width: 70%;
            border-collapse: collapse;
            margin: auto;
        }

        .table th{
            
            font-weight: 900;
            letter-spacing: 0.35px;
            text-align: center; 
            
        }

        .table td{  
            letter-spacing: 0.35px;
            font-weight: normal;
            padding: 20px 10px 20px;
            text-align: center;
        }

    </style>


</head>
<?php include "nav.php" ?>

<body>

    <h1 id="topic">
        Adminstration
    </h1>
    <div class="eventsearchbar">
        <form action="/action_page.html" class="search-bar" style="height:fit-content">
            <input type="search" class="form-ctrl" placeholder="Search event">
            <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
        </form>
    </div>
    <div class="table-container">
        <table class="table" >
            <thead>
                <tr>
                    <th>Event</th>
                    <th>User role</th>
                </tr>
            </thead>
            <tbody id="table-body">

            </tbody>   
        </table>
    </div>
    
    
</body>
<?php include "footer.php" ?>
</html>