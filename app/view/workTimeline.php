<!DOCTYPE html>
<html lang="en" id="id1">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/Public/assets/visal logo.png" type="image/icon type">
    <title>Communityretreat</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=PT+Sans&display=swap");

    textarea {
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
        font-family: "Ubuntu", sans-serif;
    }

    .rightbox {
        height: 100%;
    }

    .rb-container {
        font-family: "Ubuntu", sans-serif;
        width: 50%;
        margin: auto;
        display: block;
        position: relative;
    }

    .rb-container ul.rb {
        margin: 2.5em 0;
        padding: 0;
        display: inline-block;
    }

    .rb-container ul.rb li {
        list-style: none;
        margin: auto;
        min-height: 50px;
        border-left: 1px dashed #03142d;
        padding: 0 0 50px 30px;
        position: relative;
    }

    .rb-container ul.rb li:last-child {
        border-left: 0;
    }

    .rb-container ul.rb li::before {
        position: absolute;
        left: -18px;
        top: -5px;
        content: " ";
        border: 8px solid rgba(3, 20, 45, 1);
        border-radius: 500%;
        background: white;
        height: 20px;
        width: 20px;
        transition: all 500ms ease-in-out;
    }

    .rb-container ul.rb li.completed::before {
        background: #50d890;
        border-color: #232931;
        transition: all 500ms ease-in-out;
    }

    .act::before {
        background: #50d890;
        border-color: #232931;
        transition: all 500ms ease-in-out;
    }

    ul.rb li .timestamp {
        color: #50d890;
        position: relative;
        width: 100px;
        font-size: 12px;
    }

    input::placeholder {
        padding: 5em 5em 1em 1em;
        color: black;
    }

    input[type="date"]::before {
        content: attr(data-placeholder);
        width: 100%;
    }

    input[type="date"]:focus::before,
    input[type="date"]:valid::before {
        display: none
    }

    input[type="time"]::before {
        content: attr(data-placeholder);
        width: 100%;
    }

    input[type="time"]:focus::before,
    input[type="time"]:valid::before {
        display: none
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

    ::placeholder {
        color: black;
        opacity: 1;
    }

    @media screen and (max-width:800px) {

        .timeline {
            background: transparent;
            width: 80%;
            height: 500px;
            margin: 0 0 0 2rem;
            position: relative;
        }

        .rb-container {
            width: 100%;
        }

        .margin-md {
            margin: 10px 0px 0px 0px;
        }

        .popup .content {
            width: 80%;
        }

    }
</style>


<body>
    <div id="background">
        <div class="flex-col flex-center margin-side-lg" style="align-items: flex-start;">
            <button class="btn btn-solid btn-close margin-lg" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')">Add Task &nbsp; <i class="fas fa-plus"></i></button>
        </div>

        <div class="timeline">
            <div class="box">

            </div>

            <div class="rightbox">
                <div class="rb-container">
                    <ul class="rb">
                        <?php foreach ($tasks as $task) { ?>
                            <li class="rb-item <?= $task['completed'] != 0 ? "completed" : "" ?>">
                                <div class="timestamp">
                                    <h3><?= $task["start_date"] ?><br><?= $task["end_date"] ?></h3>
                                </div>
                                <div><?= $task["task"] ?></div>

                                <update class="margin-md flex-row-to-col">
                                    <button class="btn btn-small margin-md" onclick=" editForm('<?= $task['start_date'] ?>','<?= $task['end_date'] ?>','<?= $task['task'] ?>' ,'<?= $task['task_id'] ?>'); togglePopup('edit-form'); blur_background('background'); stillBackground('id1');"><i class="btn-icon far fa-edit margin-side-md"></i>Edit</button>

                                    <?php if ($task['completed'] == 0) { ?>
                                        <button class="btn btn-small margin-md" onclick="window.location.href='/WorkTimeline/completed?event_id=<?= $_GET['event_id'] ?>&&task_id=<?= $task['task_id'] ?>'"><i class="far fa-check-square"></i>&nbsp;&nbsp;Mark as completed</button>
                                    <?php } else { ?>
                                        <button class="btn btn-solid btn-small margin-md" onclick="window.location.href='/WorkTimeline/completed?event_id=<?= $_GET['event_id'] ?>&&task_id=<?= $task['task_id'] ?>'"><i class="far fa-check-square"></i>&nbsp;&nbsp;Completed</button>
                                    <?php } ?>

                                    <button class="btn btn-small clr-red border-red remove margin-md" onclick="remove()" required style="font-family:Ubuntu, sans-serif,  FontAwesome"> &#xf2ed; &nbsp;Remove </button>
                                    <div class="flex-row flex-space" style="display: none;">
                                        <p class="margin-side-md" style="white-space: nowrap;">Are you sure</p>
                                        <form method="post" action="/WorkTimeline/deleteTask?event_id=<?= $_GET["event_id"] ?>" class="flex-row flex-center">
                                            <input name="task_id" class="hidden" value="<?= $task["task_id"] ?>">
                                            <button class="btn-icon flex-row flex-center"><i type="submit" class="fas fa-check clr-green margin-side-md"></i>&nbsp;</button>
                                        </form>
                                        <i class="fas fa-times clr-red margin-side-md" onclick="cancel()"></i>
                                    </div>
                                </update>

                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-row flex-center">
        <ul class="pagination">
            <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=timeline"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
            <li class="<?php if ($pageno <= 1) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno <= 1) {
                                echo '';
                            } else {
                                echo "/Event/view?event_id=" . $_GET['event_id'] . "&&page=timeline&&pageno=" . ($pageno - 1);
                            } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
            </li>
            <li class="<?php if ($pageno >= $total_pages) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                                echo '';
                            } else {
                                echo "/Event/view?event_id=" . $_GET['event_id'] . "&&page=timeline&&pageno=" . ($pageno + 1);
                            } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
            </li>
            <li><a href="/Event/view?event_id=<?= $_GET['event_id'] ?>&&page=timeline&&pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
        </ul>
    </div>

    <?php if ($organization || $moderator) { ?>
        <div class="popup" id="form">
            <div class="content">
                <div>
                    <h2>New Task</h2>
                </div>
                <div>
                    <button class="btn-icon btn-close" onclick="togglePopup('form'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
                </div>
                <form action="/WorkTimeline/addTask?event_id=<?= $_GET['event_id'] ?>" method="post" class="form-container">

                    <div class="form-item">
                        <label>Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form form-ctrl" data-placeholder="Task starts on?" required></input>
                    </div>

                    <div class="form-item">
                        <label>End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form form-ctrl" data-placeholder="Task ends on?" required></input>
                    </div>

                    <div class="form-item">
                        <label>Task</label>
                        <textarea name="task" class="form form-ctrl" placeholder="Enter the task" required></textarea>
                    </div>

                    <button class="btn btn-solid margin-md" type="submit">Add Task</button>
                </form>
            </div>
        </div>
    <?php } ?>

    <?php if ($organization || $moderator) { ?>
        <div class="popup" id="edit-form">
            <div class="content">
                <form action="/WorkTimeline/editTask?event_id=<?= $_GET["event_id"] ?>" method="post" class="form-container">

                    <div class="form-item">
                        <label>Start date</label>
                        <input type="date" class="form-ctrl" placeholder="Change start date" name="start_date" id="edit-start-date" required>
                    </div>

                    <div class="form-item">
                        <label>End date</label>
                        <input type="date" class="form-ctrl" placeholder="Change end date" name="end_date" id="edit-end-date" required>
                    </div>

                    <div class="form-item">
                        <label>Task</label>
                        <textarea name="task" class="task-textarea" placeholder="Change task" id="edit-task"></textarea>
                    </div>

                    <input type="hidden" id="edit-task-id" name="task_id">
                    <button class="btn btn-solid margin-md" type="submit">Save</button>

                    <div>
                        <button type="button" class="btn-icon btn-close" onclick="togglePopup('edit-form'); blur_background('background'); stillBackground('id1')"><i class="fas fa-times"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

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

    document.getElementById("start_date").addEventListener("change", () => {
        document.getElementById("end_date").setAttribute("min", document.getElementById("start_date").value);
    });

    document.getElementById("edit-start-date").addEventListener("change", () => {
        document.getElementById("edit-end-date").setAttribute("min", document.getElementById("edit-start-date").value);
    });

    function editForm(start_date, end_date, task, task_id) {
        document.getElementById("edit-start-date").value = start_date;
        document.getElementById("edit-end-date").setAttribute("min", document.getElementById("edit-start-date").value);
        document.getElementById("edit-end-date").value = end_date;
        document.getElementById("edit-task").value = task;
        document.getElementById("edit-task-id").value = task_id;
    }

    function remove() {
        event.target.style.display = "none";
        event.target.nextElementSibling.style.display = "flex";
    }

    function cancel() {
        var cancel = event.target.parentNode;
        cancel.style.display = "none";
        cancel.previousElementSibling.style.display = "";

    }
</script>

</html>