<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Event Gallery</title>
</head>
<style>
    .form {
        min-width: 50%;
    }



    p {
        margin: 0.5rem;
    }

    .grid {
        width: 90%;
        display: grid;
        align-content: center;
        justify-content: center;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        padding-bottom: 2rem;
    }


    figure {
        height: 150px;
        width: 300px;
        position: relative;
        background: #eeeeee;
        border-radius: 6px;
        box-shadow: 0px 0px 0px 1px rgb(192, 192, 192);
        margin: 0;
        overflow: hidden;
        padding-bottom: 2rem;
    }

    figure div {
        width: 100%;
        height: 100%;
    }

    .grid div img {
        width: 100%;
        height: 100%;
        object-position: center;
        object-fit: cover;
        display: flex;
        padding: 0;
    }

    .delete-button {
        font-family: 'FontAwesome';
        top: 18px;
        background: white;
        opacity: 0.5;
        padding: 0.2rem;
        position: absolute;
        border-radius: 1px !important;
        transition: opacity 0.2s ease-in-out;
        left: 18px;
    }

    .delete-button:hover {
        opacity: 1;
    }

    .delete-button:active {
        opacity: 1;
    }

    .file-grid {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(auto-fill, 70px);
        gap: 2rem;
    }

    .file-grid img {
        object-fit: cover;
        width: 60px;
        height: 60px;
    }

    .file-grid>div {
        border-radius: 4px;
        overflow: hidden;
        position: relative;
        width: 60px;
        height: 60px;
    }

    @media screen and (max-width:800px) {
        .form {
            min-width: 80%;
        }

        .grid div {
            margin: 0px;
        }

        .event-card-details {
            flex-direction: column;
        }
    }
</style>



<body>
    <div class="flex-col flex-center margin-side-lg position-relative">
        <h1>Gallery</h1>

        <?php if ($moderator || $organization || $registered_user) { ?>
            <form class="form flex-col flex-center" id="file-form" method="post" enctype="multipart/form-data">
                <label for="files">
                    <div class="btn btn-solid margin-lg">Add photo &nbsp; <i class="fas fa-plus"></i></div>
                </label>
                <input type="file" class="hidden" id="files" name="photo" accept=".jpg, .jpeg, .png" multiple />
                <div id="selected_files" class="file-grid margin-md"></div>
                <button type="submit" class="btn save-button hidden">Save</button>
            </form>
        <?php } ?>

        <div class="grid margin-lg">
            <?php foreach ($photos as $photo) { ?>
                <figure class="item bg-green">
                    <div class="content">
                        <?php if (isset($_SESSION["user"]) && $photo["uid"] == $_SESSION["user"]["uid"]) { ?>
                            <form class="delete-button" method="post" action="/Event/deletePhoto?event_id=<?= $_GET["event_id"] ?>">
                                <input type="hidden" name="photo" value="<?= $photo["image"] ?>">
                                <button type="submit" class="btn-icon"> <i class="far fa-trash-alt"></i></button>
                            </form>
                        <?php  } ?>
                        <div class="gallery-container flex flex-center"><img src="<?= $photo["image"] ?>" style="object-fit: cover;" alt=""></div>
                        <p style="color:white;"><?= $photo["username"] ?></p>
                    </div>
                </figure>
            <?php } ?>

        </div>
        <div class="flex-row flex-center position-absolute position-bottom">
            <ul class="pagination">
                <li><a href="/Organisation/gallery?pageno=1"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>&nbsp;First</a></li>
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '';
                                } else {
                                    echo "/Organisation/gallery?pageno=" . ($pageno - 1);
                                } ?>"><i class="fas fa-chevron-left"></i>&nbsp;Prev</a>
                </li>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "/Organisation/gallery?pageno=" . ($pageno + 1);
                                } ?>">Next&nbsp;<i class="fas fa-chevron-right"></i></a>
                </li>
                <li><a href="/Organisation/gallery?pageno=<?php echo $total_pages; ?>">Last&nbsp;<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>
</body>


<script>
    const input = document.querySelector('#files');
    input.addEventListener('change', handleFileSelect);

    document.querySelector("#file-form").addEventListener("submit", handleForm);

    document.querySelector("body").addEventListener("click", (event) => {
        console.log(event.target);
        if (event.target.classList.contains("sel-file")) {
            console.log("sdfsd");
            removeFile(event);
        }
    });


    var selDiv = document.getElementById("selected_files");
    var storedFiles = [];


    function handleFileSelect(event) {
        let error_element = document.querySelector(".input-error");
        if (error_element) {
            error_element.remove();
        }
        var files = event.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function(f) {

            if (!f.type.match("image.*")) {
                return;
            }

            storedFiles.push(f);

            var reader = new FileReader();
            reader.onload = function(event) {
                var html = document.createElement("div");;
                html.innerHTML = "<img src=\"" + event.target.result + "\" data-file='" + f.name + "' class='sel-file' title='Click to remove'> <div class='delete-button sel-file'" + " data-file='" + f.name + "' >&#xf2ed;</div>";
                selDiv.appendChild(html);
            }
            reader.readAsDataURL(f);
        });
        if (storedFiles.length != 0)
            document.querySelector(".save-button").classList.remove("hidden");
    }


    function handleForm(event) {
        if (storedFiles.length == 0)
            location.reload();

        event.preventDefault();
        var formdata = new FormData();

        for (var i = 0, len = storedFiles.length; i < len; i++) {
            formdata.append('photo[]', storedFiles[i]);
        }

        $.ajax({

            url: "/Event/addPhoto?event_id=<?= $_GET["event_id"] ?>",
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                location.reload();
                return false;
            },
            error: function(request, status, error) {
                if (!document.querySelector("#file-form").firstElementChild.classList.contains("input-error")) {
                    let msg = request.responseText.match(/####(.*)####/);
                    let span = document.createElement("span");
                    span.classList.add("input-error");
                    span.innerHTML = "<i class='fas fa-exclamation-circle'></i> &nbsp" + msg[1];
                    span.style.color = "red";
                    span.style.fontSize = "0.7rem";
                    input.style.borderColor = "red";
                    document.getElementById("file-form").insertAdjacentElement("beforebegin", span);
                }
            }
        });
    }

    function removeFile(e) {
        var file = e.target.dataset["file"];
        for (var i = 0; i < storedFiles.length; i++) {
            if (storedFiles[i].name === file) {
                storedFiles.splice(i, 1);
                break;
            }
        }
        e.target.parentElement.remove();
        if (storedFiles.length == 0) {
            document.querySelector(".save-button").classList.add("hidden");
            let error_element = document.querySelector(".input-error");
            if (error_element) {
                error_element.remove();
            }
        }
    }
</script>

</html>