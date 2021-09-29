<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Feedback</title>
</head>

<style>
    .heading {
        font-size: 25px;
        margin-right: 25px;
    }

    .fa {
        font-size: 25px;
    }

    .checked {
        color: orange;
    }

    /* Three column layout */
    .side {
        float: left;
        width: 15%;
        margin-top: 10px;
    }

    .middle {
        margin-top: 10px;
        float: left;
        width: 70%;
    }

    /* Place text to the right */
    .right {
        text-align: right;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* The bar container */
    .bar-container {
        width: 100%;
        background-color: #f1f1f1;
        text-align: center;
        color: white;
    }

    #background {
        width: 80%;
        justify-content: center;
        display: flex;
        flex-direction: column;
    }

    /* Individual bars */
    .bar-5 {
        width: 60%;
        height: 18px;
        background-color: #04AA6D;
    }

    .bar-4 {
        width: 30%;
        height: 18px;
        background-color: #2196F3;
    }

    .bar-3 {
        width: 10%;
        height: 18px;
        background-color: #00bcd4;
    }

    .bar-2 {
        width: 4%;
        height: 18px;
        background-color: #ff9800;
    }

    .bar-1 {
        width: 15%;
        height: 18px;
        background-color: #f44336;
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
        width: 0.9em;
    }

    .rate:not(:checked)>label:before {
        font-family: "Font Awesome 5 Free";
        content: "\f005";
        display: inline-block;
        padding-right: 3px;
        vertical-align: middle;
        font-weight: 900;
        font-size: 1.5rem;
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: orange;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .popup .btn-close {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 30px;
        height: 30px;
        color: black;
        font-size: 1.5rem;
        padding: 2px 5px 7px 5px;
    }

    .popup.active .content {
        transition: all 300ms ease-in-out;
        transform: translate(-50%, -50%);
    }

    .blurred {
        filter: blur(2px);
        overflow: hidden;
    }

    .still {
        overflow: hidden;
    }

    .popup .content {
        position: fixed;
        transform: scale(0);
        width: 40%;
        z-index: 2;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        background: white;
        box-shadow: 0px 0px 11px 2px rgba(0, 0, 0, 0.93);
        z-index: 1;
        left: 50%;
        top: 50%;
        display: flex;
        flex-direction: column;
    }

    /* ::placeholder {
        color: black;
        opacity: 1;
    } */

    textarea {
        min-height: 200px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    .container {
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
    }

    .card-container {
        width: 80%;
    }

    .event-card-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    .opacity-reduce {
        opacity: 0.5;
    }


    /* Responsive layout - make the columns stack on top of each other instead of next to each other */
    @media (max-width: 400px) {

        .progress {
            width: 75%;
        }

        .side,
        .middle {
            width: 100%;
        }

        .right {
            display: none;
        }

        .card-container {
            height: fit-content;
            width: 80%;
        }

        .event-card-details {
            flex-direction: column;
        }
    }
</style>

<body>
    <div class="flex-col flex-center">
        <div id="background">

            <?php if ($registered_user) { ?>
                <div class="flex-col flex-center margin-side-lg">
                    <button class="btn btn-solid btn-close margin-lg" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')">Give Feedback &nbsp; <i class="far fa-comment-dots"></i></button>
                </div>
            <?php } ?>

            <div>
                <span class="heading margin-md">User Rating</span>
                <?php for ($i = 1; $i < 6; $i++) {
                    if ($i <= $avg_rate) { ?>
                        <span class="fas fa-star fa-sm checked"></span>
                    <?php } else { ?>
                        <span class="fas fa-star fa-sm"></span>
                <?php }
                } ?>
                <p class="margin-md"><?= $avg_rate ?> average based on <?= $total ?> reviews.</p>
            </div>
            <hr class="margin-lg" style="border:3px solid #f1f1f1">


            <div>
                <span class="heading margin-md">Feedbacks</span>
                <div class="flex-col flex-center" style="min-height:200px; width: 100%;">
                    <?php foreach ($feedbacks as $feedback) { ?>
                        <div class="card-container margin-md <?php if ($feedback["status"] == 'hide') echo 'opacity-reduce' ?>">
                            <div class="flex-col flex-center margin-md event-card-details">
                                <h3 class="margin-md"><?= $feedback["username"] ?></h3>
                                <date><?= $feedback["time_stamp"] ?></date>
                                <div class="margin-md">
                                    <?php for ($i = 1; $i < 6; $i++) {
                                        if ($i <= $feedback["rate"]) { ?>
                                            <span class="fas fa-star fa-sm checked"></span>
                                        <?php } else { ?>
                                            <span class="fas fa-star fa-sm"></span>
                                    <?php }
                                    } ?>
                                </div>
                                <description class="margin-md"><?= $feedback["feedback"] ?></description>
                                <?php if ($organization || $moderator) { ?>
                                    <button class="btn flex-col margin-md" onclick="window.location.href='/Feedback/statusToggle?event_id=<?= $_GET['event_id'] ?>&&feedback_id=<?= $feedback['feedback_id'] ?>'">
                                        <?php if ($feedback["status"] == 'show') { ?>
                                            <i class="far fa-eye-slash"></i>
                                        <? } else { ?>
                                            <i class="far fa-eye"></i>
                                        <? } ?>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>

        </div>

        <?php if ($registered_user) { ?>
            <div class="popup" id="form">
                <div class="content">
                    <form action="/Feedback/addFeedback?event_id= <?= $_GET["event_id"] ?>" method="post" class="form-container">

                        <div class="form-item">
                            <label>Tell us what you think about "event name" </label>
                            <textarea name="feedback" class="form-ctrl" placeholder="Enter feedback" id="feedback" required></textarea>
                        </div>

                        <div class="flex-row flex-center">
                            <label>Rate us!</label>
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>

                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>

                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>

                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>

                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>

                        <button class="btn btn-solid margin-md" type="submit">Submit</button>

                        <div>
                            <button class="btn-icon btn-close" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
                        </div>

                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

<script>
    function togglePopup(id) {
        document.getElementById(id).classList.toggle("active");
    }

    function blur_background(id) {
        document.getElementById(id).classList.toggle("blurred")
    }

    function stillBackground(id) {
        document.getElementById(id).classList.toggle("still");
    }
</script>

</html>