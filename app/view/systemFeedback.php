<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
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
<div class="system-feedback-container">
    
        <div class="flex-col flex-center margin-md card-container">
                <div class="card-head" style="text-align: center; ">
                    <h3>USER ID: REG0000045</h3>
                    <h4>Sep 30 2021</h4>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                <div class="flex-col flex-center margin-md"><button class="btn bg-green clr-white">Viewed</button></div>
                        
        </div>
        <div class="flex-col flex-center margin-md card-container">
                <div class="card-head" style="text-align: center; ">
                    <h3>USER ID: REG0000035</h3>
                    <h4>Sep 28 2021</h4>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                <div class="flex-col flex-center margin-md"><button class="btn bg-green clr-white">Viewed</button></div>
                        
        </div>
        <div class="flex-col flex-center margin-md card-container">
                <div class="card-head" style="text-align: center; ">
                    <h3>USER ID: ORG0000041</h3>
                    <h4>Aug 25 2021</h4>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                <div class="flex-col flex-center margin-md"><button class="btn bg-green clr-white">Viewed</button></div>
                        
        </div>
        <div class="flex-col flex-center margin-md card-container">
                <div class="card-head" style="text-align: center; ">
                    <h3>USER ID: ORG0000049</h3>
                    <h4>Jul 20 2021</h4>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptatem numquam laboriosam quaerat nisi repellat, nam temporibus molestias maxime eum iste velit officia deserunt recusandae voluptatum molestiae nihil ipsam et.</p>
                <div class="flex-col flex-center margin-md"><button class="btn bg-green clr-white">Viewed</button></div>
                        
        </div>
</div>
   
</body>
<?php include "footer.php"?>
<script>

</script>

</html>