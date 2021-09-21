<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
<div >
    <textarea name="" id="editor" cols="30" rows="10"></textarea>
    <p>Here goes the initial content of the editor.</p>
</div>

</body>
<script src="/Libararies/ckeditor5-29.2.0/packages/ckeditor5-build-classic/build/ckeditor.js"></script>
<script>

    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

</script>
</html>