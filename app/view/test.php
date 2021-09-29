<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>

</head>
<style>
    .file-grid {
        display: grid;
        width: 50%;
        grid-template-columns: repeat(auto-fill, 70px);
        gap: 2rem;
    }

    .file-grid img {
        width: 60px;
    }
</style>

<body>
    <form id="myForm" method="post">
        <label for="">Files</label>
        <input type="file" id="files" name="photo[]" accept=".jpg, .jpeg, .png" multiple><br />
        <div id="selected_files" class="file-grid"></div>
        <input type="submit">
    </form>

</body>

<!--  -->
<script src="/Public/assets/js/input_validation.js"></script>

<script>
    const input = document.querySelector('#files');
    input.addEventListener('change', handleFileSelect);

    document.querySelector("#myForm").addEventListener("submit",handleForm);
    document.querySelector("body").addEventListener("click",(event)=>{
        console.log(event.target);
        if(event.target.classList.contains("selFile")){
            console.log("sdfsd");
            removeFile(event);
        }
    });


    var selDiv = "";
    var storedFiles = [];

    $(document).ready(function() {
        /* $("#files").on("change", handleFileSelect); */

        selDiv = $("#selected_files");
        //$("#myForm").on("submit", handleForm);

        //$("body").on("click", ".selFile", removeFile);
    });

    function handleFileSelect(event) {
        var files = event.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function(f) {

            if (!f.type.match("image.*")) {
                return;
            }

            storedFiles.push(f);

            var reader = new FileReader();
            reader.onload = function(event) {
                var html = "<div><img src=\"" + event.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'></div>";
                selDiv.append(html);
            }
            reader.readAsDataURL(f);
        });
    }


    function handleForm(event) {
        event.preventDefault();
        var formdata = new FormData();

        for (var i = 0, len = storedFiles.length; i < len; i++) {
            formdata.append('photos[]', storedFiles[i]);
        }

        $.ajax({
            url: "/Organisation/test",
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                return true;
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
    }

</script>

</html>