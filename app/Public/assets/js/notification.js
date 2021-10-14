
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
                path : notification_data[i].path


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
                path : notification_data[i].path


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
                path : notification_data[i].path


            }
            
        ]
        notify_data.push(item);
        
    }
   
}
console.log(notify_data[0][0].imgname);


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
    descriptiondiv.setAttribute("onClick",data[0].path);
    descriptiondiv.innerText = data[0].description;
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

