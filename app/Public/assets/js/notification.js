let notify_data = [
    {
        imgname : "../Public/assets/visal logo.png",
        orgnaization : "Leo club UCSC"
    },
    {
        imgname : "../Public/assets/visal logo.png",
        orgnaization : "Leo club UCSC"
    },
    {
        imgname : "../Public/assets/visal logo.png",
        orgnaization : "Leo club UCSC"
    },
    {
        imgname : "../Public/assets/visal logo.png",
        orgnaization : "Leo club UCSC"
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
    descriptiondiv.innerText =  "You received an email from " + data.orgnaization + ".";
    notificationbar.appendChild(descriptiondiv);
    document.querySelector('.notifications-form').appendChild(notificationbar);


}