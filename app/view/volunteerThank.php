<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <title>Document</title>
</head>
<style>
    div{
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-59%);
    }
</style>
<body>
    <div>
    <h1>Thank you for joining with us</h1>

    </div>
    
</body>
<script>
     setTimeout(function(){
            window.location.href = '/event/view?page=about&&event_id=<?= $_GET["event_id"] ?>';
         }, 5000);
</script>
</html>