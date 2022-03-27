<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="icon" href="/Public/assets/visal logo.png" type="image/icon type">
    <title>Communityretreat</title>
</head>
<style>
    div {
        width: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -59%);
        text-align: center;
    }

    img {
        width: 70%;
        aspect-ratio: 4/1.2;
        height: 21%;
        object-fit: cover;
    }
</style>

<body>
    <div>
        <img class="border-round" src="<?= $event_details['cover_photo'] ?>" alt="">
        <h1>Thank you for joining with</h1>
        <h1><?= $event_details["event_name"] ?></h1>
    </div>

</body>
<script>
    setTimeout(function() {
        window.location.href = '/Event/view?page=about&&event_id=<?= $_GET["event_id"] ?>';
    }, 5000);
</script>

</html>