const dp = document.querySelector('.profilepic-pic-div'); 
const img = document.querySelector('#dp');
const file = document.querySelector('#file');
const uploadbtn = document.querySelector('#uploadbtn');

dp.addEventListener('mouseenter', function()  //When enter the mouse cursor pop up the change profile pic button
{
    uploadbtn.style.display = "block"; //Display the button
});

dp.addEventListener('mouseleave',function() //When leave the mouse cursor pop up the change profile pic button
{
    uploadbtn.style.display = "none"; //Hide the button
});

file.addEventListener('change', function(){ //Send data to controller when listen a change

    const choosedfile = this.files[0]; //Send only one photo
    var form_data = new FormData(); //Create formdata object                 
    form_data.append('profile_pic[]', choosedfile); //Append the profile pic to the formData

    if(choosedfile){ //If set a file

        const reader = new FileReader();

        reader.addEventListener('load',function(){
           img.setAttribute('src',reader.result); //Set new profile pic
        });

     reader.readAsDataURL(choosedfile);
     $.ajax({
       
        url: "/User/updateProfilePic", //Call controller's method
        type: "POST",
        data: form_data,
        processData: false,
        contentType: false,
    });
        
    }
});