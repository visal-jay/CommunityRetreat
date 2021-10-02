let table_data = [];
let activities = renderActivities();
for(let i=0 ; i < activities.length ; i++ ){
    if(activities[i].event_id==null){
        let item = 
        {
            event_id: null,
            date : activities[i].time_stamp,
            Activity: activities[i].activity
        }
        table_data.push(item);
    }
    else{
        let item = 
        {
            event_id: activities[i].event_id,
            date : activities[i].time_stamp,
            Activity: activities[i].activity,
            eventname: activities[i].event_name
           
        }
        table_data.push(item);

    }
}

   

table_data.map(addDataRow)
function addDataRow(data,index){
    
    let tr = document.createElement('tr');
   


    let date = document.createElement('td');
    let datelabel = document.createElement('div');
    datelabel.setAttribute("class","data-label");
    datelabel.innerText = "Date";
    date.appendChild(datelabel);
    let datediv = document.createElement('div');
    datediv.setAttribute("class","data");
    datediv.innerText = data.date;
    date.appendChild(datediv);
    tr.appendChild(date);

    let activity = document.createElement('td');
    let activitylabel = document.createElement('div');
    activitylabel.setAttribute("class","data-label");
    activitylabel.innerText = "Activity";
    activity.appendChild(activitylabel);
    let activitydiv = document.createElement('div');
    activitydiv.setAttribute("class","data");
    let activity_description = document.createElement("p");
    activity_description.innerText = data.Activity;
    if(data.event_id != null){
        let event_link = document.createElement("a");
        event_link.innerText = " "+ data.eventname;
        event_link.setAttribute("href","/event/view?page=about&&event_id="+data.event_id);
        activity_description.appendChild(event_link);  
    }

    activitydiv.appendChild(activity_description);
    activity.appendChild(activitydiv);
    tr.appendChild(activity);


    let action = document.createElement('td');
    action.setAttribute("class","action-div");
    let actiondiv = document.createElement('div');
    actiondiv.setAttribute("class","action");
    actiondiv.innerHTML = '<button class="btn bg-red clr-white border-red" onclick="popupLoad()">Remove</button>';
    action.appendChild(actiondiv);
    tr.appendChild(action);

    document.getElementById("table-body").appendChild(tr);
}

function onDelete(index) {
   
        table_data.splice(index,1);
        document.getElementById("table-body").innerHTML = "";
        table_data.map(addDataRow);
        popupLoad();

   
}
function successCall(result){
    var activities = JSON.parse(result);
    
    return activities;
}



function renderActivities(){

     var activities = "";
   
    $.ajax({
        async:false,
        url: "/User/viewActivityLog",
        type: "post",
        success : function(result){
            console.log(result);
            activities = JSON.parse(result);
           
       },

    });
    return activities;

}
console.log(renderActivities());