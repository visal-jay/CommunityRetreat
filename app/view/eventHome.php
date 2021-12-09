<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="me" href="https://twitter.com/twitterdev">
    <link rel="canonical" href="/web/tweet-button">
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <title>CommunityRetreat</title>
</head>

<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-gap: 2rem;
        grid-auto-rows: minmax(180px, auto);
        grid-auto-flow: dense;
        padding: 1px;
        margin: 3rem;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .card p,
    h1,
    h2 {
        margin: 0;
    }

    .box {
        backdrop-filter: blur(10px);
        height: 100%;
        width: 100%;
        border-radius: 8px;
    }

    .span-col-2 {
        grid-column-end: span 2;
    }

    .span-col-3 {
        grid-column-end: span 3;
    }

    .span-col-4 {
        grid-column-end: span 4;
    }

    .span-row-2 {
        grid-row-end: span 2;
    }



    .card {
        border-radius: 8px;
        position: relative;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;

    }

    .card:before {
        content: '';
        display: block;
        width: 100%;
    }


    .card__background {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
        border-radius: 8px;
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transform-origin: center;
        transform: scale(1) translateZ(0);
        transition:
            filter 200ms linear,
            transform 200ms linear;
    }

    .card:hover .card__background {
        transform: scale(1.05) translateZ(0);
    }

    .card-grid:hover>.card:not(:hover) .card__background {
        filter: brightness(0.8) contrast(1.2);
    }

    .bg-image-1 {
        background-image: url(https://images.unsplash.com/photo-1557177324-56c542165309?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);
    }

    .bg-image-2 {
        background-image: url(https://cdn.dribbble.com/users/1321439/screenshots/4075608/patterns_within_patterns__dribbble.jpg);
    }

    .bg-image-3 {
        background-image: url(/Public/assets/sample.jpeg);
    }

    .bg-image-4 {
        background-image: url(https://thumbs.dreamstime.com/z/yellow-psychedelic-abstract-background-chaotic-colorful-swirls-background-made-interweaving-curved-shapes-vector-illustration-104474961.jpg);
    }

    .bg-image-5 {
        background-image: url(https://thumbs.dreamstime.com/z/abstract-fantasy-green-liquid-marble-texture-background-abstract-fantasy-green-liquid-marble-texture-background-web-background-139915003.jpg);
    }

    .bg-event {
        background-position: center;
        background-size: cover;
        animation: none !important;
    }

    @media screen and (max-width:767px) {
        .grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .span-col-2 {
            grid-column: 1/-1;
        }

        .span-col-3 {
            grid-column: 1/-1;
        }

        .span-col-4 {
            grid-column: 1/-1;
        }

        .span-row-2 {
            grid-row-end: span 1;
        }
    }

    .object {
        animation: fadeInUpBig 15s linear infinite;
    }

    @keyframes fadeInUpBig {
        from {
            -webkit-transform: translate3d(0, 200px, 0);
            transform: translate3d(0, 200px, 0);
        }

        to {
            -webkit-transform: translate3d(0, -200px, 0);
            transform: translate3d(0, -200px, 0);
        }
    }
</style>

<body>
    
    <div id="container" class="grid card-grid">
        <div class="card  box one span-col-4 span-row-2">
            <div class="card__background gradient-2 bg-event" style=" background-image: linear-gradient(0deg, rgb(32 32 32 / 72%), rgb(255 255 255 / 0%)), url(<?= $cover_photo ?>);">
                <div style="display: flex;height: 100%;align-items: flex-end;">
                    <h1 class="margin-lg clr-white"><?= $event_name ?></h1>
                </div>
            </div>
        </div>
        <?php if ($donation_status == 1) { ?>
            <div class="card">
                <div class="card__background flex-col flex-center bg-image-1">
                    <div class="flex-col flex-center box">
                        <h1 class="clr-white"><?php echo (int)$donation_percent ?>%</h1>
                        <p class="clr-white">Collected</p>
                        <button class="btn btn-solid margin-md" onclick="window.location.href='/Event/view?page=about&event_id=<?= $_GET['event_id'] ?>&action=donate'">Donate</button>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($volunteer_status == 1) { ?>
            <div class="card">
                <div class="card__background flex-col flex-center bg-image-2">
                    <div class="flex-col flex-center box">
                        <h1 class="clr-white"><?php echo (int)$volunteer_percent ?>%</h1>
                        <p class="clr-white">Volunteered</p>
                        <button class="btn btn-solid margin-md" onclick="window.location.href='/Event/view?page=about&event_id=<?= $_GET['event_id'] ?>&action=volunteer''">Volunteer</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="card">
            <div class="card__background flex-col flex-center bg-image-4">
                <div class="flex-col flex-center box" onclick="window.location.href='/Organisation/view?page=about&org_id=<?= $org_uid ?>'">
                    <h2 class="clr-white">Organized by:</h2>
                    <h3 class="clr-white"><?= $organisation_username ?></h3>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card__background flex-col flex-center bg-image-5">
                <div class="flex-col flex-center box" onclick="window.location.href='/Event/view?page=about&event_id=<?= $_GET['event_id'] ?>'">
                    <h2 class="clr-white">Find out more</h2>
                </div>
            </div>
        </div>

        <div class="card span-col-3">
            <div class=" card__background bg-image-3">
                <div class="box flex-row flex-center" style="overflow:hidden">
                    <div class="flex-col flex-center" style="text-align:center">
                        <h4 class="margin-md flex-row flex-center">Want to clear out all your doubts?<br>Curious to know who we are?</h4>
                        <p>We are just one click away!</p>
                        <div>
                            <button class="btn btn-solid margin-md" onclick="window.location.href='/RegisteredUser/chatApp?new_chat_id=<?= 'EVN' . $_GET['event_id'] ?>'">Chat with us</button>
                        </div>
                    </div>
                    <div class="flex-row flex-center">
                        <img src="/Public/assets/messages.svg" class="object" style="width:220px" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex-row flex-center card__background" style="background-color: #1da1f2ba;">
                <div class="flex-col flex-center">
                    <h2 class="clr-white">Share us on</h2>
                    <div class="margin-md">
                        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button margin-md" data-size="large" data-show-count="false">Tweet</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex-col flex-center card__background" style="background-color: #4267B2;">
                <h2 class="clr-white">Share us on</h2>
                <div class="margin-md" style="margin-bottom: 12px; border-radius:20px; overflow:hidden;width:75px">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0" nonce="xqUnsUm7"></script>
                    <div class="fb-share-button" data-href="https://www.communityretreat.me/Event/view?page=about&event_id=<?= $_GET['event_id'] ?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                </div>
            </div>
        </div>

        <div class="card box one">
            <div class="flex-row flex-center card__background bg-red">
                <div class="flex-col flex-center">
                    <h2 class="clr-white" style="text-align: center;">Something wrong?</h2>
                    <div class="margin-md">
                        <button class="btn clr-red bg-white border-red">Complain</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>