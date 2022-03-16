<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CommunityRetreat</title>
</head>
<style>
  .system-feedback-container{
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    width: 80%;
    min-height: 100%;
    margin: auto;
  }

</style>


<?php if($admin) include "nav.php" ?>

<body>


<h1 style="text-align:center;">System feedbacks</h1>
<div class="system-feedback-container" id="feedback-container">
    <?php foreach($system_feedbacks as $system_feedback){?>
        <div class="flex-col flex-center margin-md card-container">
            <div class="card-head" style="text-align: center; ">
                <h3><?= $system_feedback['uid']?></h3>
                <p style="margin-top:-12px;"><?= $system_feedback['date']?><p>
            </div>
            <p><?= $system_feedback['feedback']?></p>
            <?php 
            if( $system_feedback['viewed'] == 0){
            ?>
                <form action="/Admin/feedbackViewed" method="post" class="flex-center margin-md">
                    <input type="hidden" name="feedback_id" value="<?= $system_feedback['feedback_id']?>" ></input>
                    <button  class="btn bg-green clr-white " id="view-btn" >Mark as viewed</button>
                </form>
            <?php }
             else if( $system_feedback['viewed'] == 1){
            ?>
                <div class="flex-center margin-md">
                    <h4 class="clr-green"><i class="fas fa-check-circle clr-green"></i>&nbspViewed</h4>
                </div>

             
            <?php } ?>
            
                            
        </div>
    <?php } ?>

 
</div>

<div class="flex-row flex-center ">
            <ul class="pagination">
                <li><a href="/Admin/systemFeedbacks?pageno=1"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '';
                                } else {
                                    echo "/Admin/systemFeedbacks?pageno=" . ($pageno - 1);
                                } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
                </li>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "/Admin/systemFeedbacks?pageno=" . ($pageno + 1);
                                } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
                </li>
                <li><a href="/Admin/systemFeedbacks?pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </div>
</body>
<?php include "footer.php"?>


</html>