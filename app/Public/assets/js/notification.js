
let notification_data = getNotifications();

var notify_data = [];

for(let i=0;i<notification_data.length;i++){
    
    if(notification_data[i].status == "event"){
        let item = [
            {
                notification_id : i,
                event_id : notification_data[i].event_id,
                imgname : "/../.."+notification_data[i].event_cover_pic,
                description : notification_data[i].description,
                path : notification_data[i].path,
                date: notification_data[i].time_stamp


            }
            
        ]
        notify_data.push(item);
    }
    if(notification_data[i].status == "organization"){

        let item = [
            {
                notification_id : i,
                event_id :"",
                imgname : notification_data[i].org_profile_pic,
                description : notification_data[i].description,
                path : notification_data[i].path,
                date: notification_data[i].time_stamp


            }
            
        ]
        notify_data.push(item);
        
    }

    if(notification_data[i].status == "system"){

        let item = [
            {
                notification_id : i,
                event_id : "",
                imgname : "../Public/assets/visal logo.png",
                description : notification_data[i].description,
                path : notification_data[i].path,
                date: notification_data[i].time_stamp

            }
            
        ]
        notify_data.push(item);
        
    }
   
}

function renderNotifications(){
    var count = 0;
    var div_count = 0;
    if(notify_data == []){
        let empty_notifcation_messege = document.createElement('h2');
        empty_notifcation_messege.style.color = 'lightslategray';
        empty_notifcation_messege.style.padding = '0.5rem 0 0 0';
        empty_notifcation_messege.style.textAlign = 'center';
        empty_notifcation_messege.innerText = "No Notifications Yet";
        document.querySelector('.notifications-form').appendChild(empty_notifcation_messeg);
    }

    while(count < notify_data.length){
        document.getElementById("empty-div-message").innerText = "";
        let tenNotificationsDiv = document.createElement('div');
        tenNotificationsDiv.setAttribute("class","ten-notifications-div");
        tenNotificationsDiv.setAttribute("id",div_count);
       
        for(let i = count; (i < count+10 ) && (i !=  notify_data.length) ; i++){

            let notificationbar = document.createElement('div');
            notificationbar.setAttribute("class","notificationbar");
            let imagediv =  document.createElement('div');
            imagediv.setAttribute("class","image-div");
            let img = document.createElement('img');
            img.setAttribute("src",notify_data[i][0].imgname);
            imagediv.appendChild(img);
            notificationbar.appendChild(imagediv);
            let descriptiondiv=  document.createElement('div');
            descriptiondiv.setAttribute("class","description");
            descriptiondiv.setAttribute("onClick",notify_data[i].path);
            descriptiondiv.innerText = notify_data[i][0].description;
            const time_stamp = new Date(notify_data[i][0].date);
            let time = document.createElement('p');
            time.setAttribute("id","moment-text");  
            time.innerText = moment(time_stamp).fromNow();
            descriptiondiv.appendChild(time);
            notificationbar.appendChild(descriptiondiv);
            tenNotificationsDiv.appendChild(notificationbar);
        }

        document.querySelector('.notifications-form').appendChild(tenNotificationsDiv);

        if(div_count > 0){
            document.getElementById(div_count).style.display = 'none';
            
        }
        count +=10;
        div_count +=1;
    
    }
 
    if(div_count > 0 && count > 10){ 
        
        let load_more_button = document.createElement('h3');
        // load_more_button.setAttribute('class', 'btn');
        load_more_button.setAttribute('id', 'loadmore_btn');
        load_more_button.style.color = '#05a9b3';
        load_more_button.style.margin = '10px 0 0 0';
        load_more_button.style.cursor = 'pointer';
        load_more_button.innerText = "Load more";
        load_more_button.value = 0;
        load_more_button.setAttribute('onclick','loadMore()');
        document.querySelector('.notifications-form').appendChild(load_more_button);
    }
}

function loadMore(){
   var loadMore_btn =  document.getElementById('loadmore_btn');
   var ten_notifications_div_id = parseInt(loadMore_btn.value) + 1;
   var ten_notifications_div = document.getElementById(ten_notifications_div_id);
   console.log(!!ten_notifications_div && ten_notifications_div.classList.contains('ten-notifications-div'));
   if(!!ten_notifications_div && ten_notifications_div.classList.contains('ten-notifications-div')){
        ten_notifications_div.style.display = '';
        loadmore_btn.value = ten_notifications_div_id;
   }
   else{
        loadMore_btn.style.display = 'none';
   }
  

}


function successCall(result){
    var notification_details = JSON.parse(result);
    
    return notification_details;
}


function getNotifications(){

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

