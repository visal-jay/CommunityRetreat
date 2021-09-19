const dp = document.querySelector('.profilepic-pic-div');
const img = document.querySelector('#dp');
const file = document.querySelector('#file');
const uploadbtn = document.querySelector('#uploadbtn');

dp.addEventListener('mouseenter', function()
{
    uploadbtn.style.display = "block";
});

dp.addEventListener('mouseleave',function()
{
    uploadbtn.style.display = "none";
});

file.addEventListener('change', function(){

    const choosedfile = this.files[0];
    var form_data = new FormData();                  
    form_data.append('profile_pic', choosedfile);

    if(choosedfile){

        const reader = new FileReader();

        reader.addEventListener('load',function(){
           img.setAttribute('src',reader.result);
        });

     reader.readAsDataURL(choosedfile);
     $.ajax({
       
        url: "ajax/RegisteredUser/updateProfilePic",
        type: "POST",
        data: form_data,
        processData: false,
        contentType: false,
    });
        
    }
});