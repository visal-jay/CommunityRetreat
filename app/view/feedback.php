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
    <title>CommunityRetreat</title>
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

    #background {
        width: 80%;
        justify-content: center;
        display: flex;
        flex-direction: column;
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

    .event-card-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .opacity-reduce {
        opacity: 0.5;
    }


    .grid-container {
        display: grid;
        height: 100%;
        grid-gap: 1rem;
        grid-template-columns: repeat(auto-fill, 300px);

    }

    .feedback-card {

        min-height: 100px;
        margin: 0;
        min-width: 230px;
        width: 230px;

    }

    .feedback-card:hover {
        transform: scale(1.02);
        transition-duration: 0.5s;
    }

    .image-div {
        display: flex;
        align-self: center;
        height: 60px;
        width: 60px;
        border-radius: 50%;
        overflow: hidden;
        transform: translate(0%, 0%);
        border: 2px solid rgb(252, 246, 246);
        background: rgb(202, 196, 196);
        object-fit: cover;
    }

    .image-div img {
        height: 60px;
        width: 60px;
    }

    .description {
        font-size: medium;
        font-weight: 300;
        margin: 20px 0 10px;
        height: 5rem;
        overflow: scroll;
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

        .event-card-details {
            flex-direction: column;
        }

        .feedback-card {
            width: 230px;
        }
    }


    @media screen and (max-width:800px) {
        .grid-container {
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, 280px);
        }

        .feedback-card {
            width: 200px;
        }
    }
</style>

<?php include "feedbackComplaint.php" ?>

<body id="body">
    <div class="flex-col flex-center">
        <div id="background">

            <?php if ($registered_user) { ?>
                <div class="flex-col flex-center margin-side-lg" style="align-items: flex-start;">
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
                <p class="margin-md"><?= sprintf('%0.2f', round($avg_rate, 2)) ?> average based on <?= $total ?> reviews.</p>
            </div>
            <hr class="margin-lg" style="border:3px solid #f1f1f1">


            <div>
                <span class="heading margin-md">Feedbacks</span>
                <div class="flex-center grid-container margin-md" style="min-height:200px; width: 100%;">
                    <?php foreach ($feedbacks as $feedback) { ?>
                        <div class="card-container margin-md feedback-card <?php if ($feedback["status"] == 'hide') echo 'opacity-reduce' ?>">
                            <div class="flex-col margin-md event-card-details">
                                <div class="flex-row">
                                    <div>
                                        <img class="image-div" src="/../..<?= $feedback["profile_pic"] ?>">
                                    </div>
                                    <div>
                                        <h3 class="margin-md" style="margin:12px 10px 10px 10px; "><?= $feedback["username"] ?></h3>
                                    </div>
                                </div>
                                <div class="description">
                                    <description class="margin-md " style="font-size:medium; font-weight:350; margin:20px 0 10px;"><?= $feedback["feedback"] ?></description>
                                </div>
                                <div class="margin-md flex-row flex-center">
                                    <?php for ($i = 1; $i < 6; $i++) {
                                        if ($i <= $feedback["rate"]) { ?>
                                            <span class="fas fa-star fa-sm checked"></span>
                                        <?php } else { ?>
                                            <span class="fas fa-star fa-sm"></span>
                                    <?php }
                                    } ?>
                                </div>
                                <div class="flex-col flex-center">
                                    <date style="font-size: 0.8rem; font-weight:100;"><?= date('j M Y ', strtotime($feedback['time_stamp'])) ?></date>

                                    <?php if ($organization || $moderator) { ?>
                                        <button class="btn bg-green flex-col margin-md " style="border-radius: 40px; width: 200px; " onclick="window.location.href='/Feedback/statusToggle?event_id=<?= $_GET['event_id'] ?>&&feedback_id=<?= $feedback['feedback_id'] ?>'">
                                            <?php if ($feedback["status"] == 'show') { ?>
                                                <i class="far fa-eye-slash clr-white"></i>
                                            <?php  } else { ?>
                                                <i class="far fa-eye clr-white"></i>
                                            <?php } ?>
                                        </button>

                                        <button class="btn btn-solid complaint-btn" style="background-color: #ff002b; border:none; border-radius: 40px; width: 200px;" onclick="popupFormandFillComplaint('complaint-form','<?= $feedback['username'] ?>','<?= $feedback['feedback_id'] ?>','<?= $feedback['uid'] ?>','<?= $_GET['event_id'] ?>');" ;>Complain &nbsp;<i class="far fa-comments"></i></button>

                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>

        </div>

        <div class="flex-row flex-center">
            <ul class="pagination">
                <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=feedback"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '';
                                } else {
                                    echo "/Event/view?event_id=".$_GET['event_id']."&&page=feedback&&pageno=" . ($pageno - 1);
                                } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
                </li>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '';
                                } else {
                                    echo "/Event/view?event_id=".$_GET['event_id']."&&page=feedback&&pageno=" . ($pageno + 1);
                                } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
                </li>
                <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=feedback&&pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </div>

        <?php if ($registered_user) { ?>
            <div class="popup" id="form">
                <div class="content">
                    <form action="/Feedback/addFeedback?event_id= <?= $_GET["event_id"] ?>" method="post" class="form-container">

                        <div class="form-item">
                            <label>Tell us what you think about <?= $event_name?> </label>
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

    <div class="popup" id="complaint_feedback_id">
        <div class="content">
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
                    </div>

                </div>
            <?php } ?>

            <div>
                <button type="button" class="btn-icon btn-close" onclick="window.location.href='/Event/view?page=feedback&event_id=<?= $_GET['event_id'] ?>' "><i class="fas fa-times"></i></button>
            </div>
        </div>
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

    <?php if ($admin && isset($_GET["complaint_feedback_id"])) { ?>
        window.addEventListener('load', (event) => {
            togglePopup('complaint_feedback_id');
            blur_background('background');
            stillBackground('id1')
        });
    <?php } ?>
</script>

</html>