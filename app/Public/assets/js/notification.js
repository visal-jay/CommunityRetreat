
let notification_data = renderNotifications();
console.log(notification_data);

let notify_data = [];

for(let i=0;i<notification_data.length;i++){
 
    if(notification_data[i].status == "event"){
        let item = [
            {
                event_id : notification_data[i].event_id,
                imgname : "/../.."+notification_data[i].event_cover_pic,
                description : notification_data[i].description,
                orgnaization : notification_data[i].organisation_username

            }
            
        ]
        notify_data.push(item);
    }
    if(notification_data[i].status == "organization"){

        let item = [
            {
                event_id :"",
                imgname : notification_data[i].org_profile_pic,
                description : notification_data[i].description,
                orgnaization : notification_data[i].organisation_username

            }
            
        ]
        notify_data.push(item);
        
    }
    if(notification_data[i].status == "system"){

        let item = [
            {
                event_id : "",
                imgname : "../Public/assets/visal logo.png",
                description : notification_data[i].description,
               

            }
            
        ]
        notify_data.push(item);
        
    }
   
}
console.log(notify_data[0][0].imgname);

// let notify_data = [
//     {
//         imgname : "../Public/assets/visal logo.png",
//         description:" you have an email from",
//         orgnaization : "Leo club Nilwala"
//     },
//     {
//         imgname : "../Public/assets/organisation.png",
//         description:" Beach cleaning event has been removed",
//         orgnaization : ""
//     },
//     {
//         imgname : "../Public/assets/org.png",
//         description:" You successfully volunteered to",
//         orgnaization : "Leo club UCSC"
//     },
//     {
//         imgname : "../Public/assets/user.png",
//         description:" you have an email from",
//         orgnaization : "Embark"
//     },
//     {
//         imgname : "../Public/assets/visal logo.png",
//         description:" you have an email from",
//         orgnaization : "Leo club Nilwala"
//     },
//     {
//         imgname : "../Public/assets/organisation.png",
//         description:" Beach cleaning event has been removed",
//         orgnaization : ""
//     },
//     {
//         imgname : "../Public/assets/org.png",
//         description:" You successfully volunteered to",
//         orgnaization : "Leo club UCSC"
//     },
//     {
//         imgname : "../Public/assets/user.png",
//         description:" you have an email from",
//         orgnaization : "Embark"
//     }
   
// ]

notify_data.map(addDatacontainer);

function addDatacontainer(data){

    let notificationbar = document.createElement('div');
    notificationbar.setAttribute("class","notificationbar");
    let imagediv =  document.createElement('div');
    imagediv.setAttribute("class","image-div");
    let img = document.createElement('img');
    img.setAttribute("src",data[0].imgname);
    imagediv.appendChild(img);
    notificationbar.appendChild(imagediv);
    let descriptiondiv=  document.createElement('div');
    descriptiondiv.setAttribute("class","description");
    let a = document.createElement("a");
    a.innerText =  data[0].description +".";
    if(data[0].event_id != ""){
        a.setAttribute("href","/event/view?page=about&&event_id="+data[0].event_id);
    }
    descriptiondiv.appendChild(a); 
    notificationbar.appendChild(descriptiondiv);
    document.querySelector('.notifications-form').appendChild(notificationbar);


}

function successCall(result){
    var notification_details = JSON.parse(result);
    
    return notification_details;
}


function renderNotifications(){

     var notification_details="";
   
    $.ajax({
        async:false,
        url: "/User/getNotifications",
        type: "post",
        success : function(result){
            
            notification_details = JSON.parse(result);
           
       },

    });
    return notification_details;

}

