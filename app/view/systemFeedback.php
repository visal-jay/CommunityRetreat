<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<style>
  .system-feedback-container{
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    width: 80%;
    height:max-content;
    margin: auto;
  }

</style>


<?php if($admin) include "nav.php" ?>

<body>


<h1 style="text-align:center;">System feedbacks</h1>
<div class="system-feedback-container" id="feedback-container">
    

 
</div>
   
</body>
<?php include "footer.php"?>
<script>
 

        $.ajax({
        async: false,
        url: "/Admin/viewFeedbacks",
        type: "post",
        success : function(feedbacks){
            let results = document.getElementById("feedback-container");
            if (feedbacks !== null)   JSON.parse(feedbacks).forEach(s => {
                console.log(feedbacks);
                    results.innerHTML +=
                `<div class="flex-col flex-center margin-md card-container">
                    <div class="card-head" style="text-align: center; ">
                        <h3> ${s.uid}</h3>
                        <p style="margin-top:-12px;">${s.date}<p>
                    </div>
                    <p>${s.feedback}</p>
                    <div  id="${s.feedback_id}"class="flex-center margin-md"><button  onClick="viewBtn('${s.feedback_id}')" class="btn bg-green clr-white " id="view-btn" >View</button></div>
                            
                </div>`;
            });    
         }

        });
        function viewBtn(id){
            var data = new FormData();
            data.append("feedback_id", id);
            $.ajax({
            url: "/Admin/feedbackViewed",
            type: "post",
            data: {
                      data: data
                    },
         
            });
            document.getElementById(id).innerHTML = `<h4 class="clr-green"><i class="fa fa-check clr-green"></i>&nbspViewed</h4>`;
        }

</script>

</html>