let notify_data = [
    {
        imgname : "../Public/assets/visal logo.png",
        description:" you have an email from",
        orgnaization : "Leo club Nilwala"
    },
    {
        imgname : "../Public/assets/organisation.png",
        description:" Beach cleaning event has been removed",
        orgnaization : ""
    },
    {
        imgname : "../Public/assets/org.png",
        description:" You successfully volunteered to",
        orgnaization : "Leo club UCSC"
    },
    {
        imgname : "../Public/assets/user.png",
        description:" you have an email from",
        orgnaization : "Embark"
    },
    {
        imgname : "../Public/assets/visal logo.png",
        description:" you have an email from",
        orgnaization : "Leo club Nilwala"
    },
    {
        imgname : "../Public/assets/organisation.png",
        description:" Beach cleaning event has been removed",
        orgnaization : ""
    },
    {
        imgname : "../Public/assets/org.png",
        description:" You successfully volunteered to",
        orgnaization : "Leo club UCSC"
    },
    {
        imgname : "../Public/assets/user.png",
        description:" you have an email from",
        orgnaization : "Embark"
    }
   
]

notify_data.map(addDatacontainer);

function addDatacontainer(data){

    let notificationbar = document.createElement('div');
    notificationbar.setAttribute("class","notificationbar");
    let imagediv =  document.createElement('div');
    imagediv.setAttribute("class","image-div");
    let img = document.createElement('img');
    img.setAttribute("src",data.imgname);
    imagediv.appendChild(img);
    notificationbar.appendChild(imagediv);
    let descriptiondiv=  document.createElement('div');
    descriptiondiv.setAttribute("class","description");
    descriptiondiv.innerText =  data.description +" " + data.orgnaization + ".";
    notificationbar.appendChild(descriptiondiv);
    document.querySelector('.notifications-form').appendChild(notificationbar);


}