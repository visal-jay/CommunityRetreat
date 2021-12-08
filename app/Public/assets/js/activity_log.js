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
    datediv.setAttribute("class","data date");
    datediv.innerText = new Date(data.date).toLocaleDateString('en-GB', {  day: 'numeric', month: 'short', year:  'numeric',});
    date.appendChild(datediv);
    tr.appendChild(date);

    let activity = document.createElement('td');
    let activitylabel = document.createElement('div');
    activitylabel.setAttribute("class","data-label");
    activitylabel.innerText = "Activity";
    activity.appendChild(activitylabel);
    let activitydiv = document.createElement('div');
    activitydiv.setAttribute("class","data");
    if(data.event_id != null){
        let event_link = document.createElement("a");
        event_link.innerText = data.Activity;
        event_link.setAttribute("href","/Event/view?page=about&&event_id="+data.event_id);
        activitydiv.appendChild(event_link);  
    }
    else{
        let activity_description = document.createElement("p");
        activity_description.innerText = data.Activity;
        activitydiv.appendChild(activity_description);
    } 
    activity.appendChild(activitydiv);
    tr.appendChild(activity);


    let action = document.createElement('td');
    action.setAttribute("class","action-div");
    let actiondiv = document.createElement('div');
    actiondiv.setAttribute("class","action");
    actiondiv.innerHTML = `<button class="btn bg-red clr-white border-red "  onclick="popupLoad('${index}')">Remove</button>`;
    action.appendChild(actiondiv);
    tr.appendChild(action);

    document.getElementById("table-body").appendChild(tr);

    
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
            activities = JSON.parse(result);   
       },

    });
    return activities;

}
