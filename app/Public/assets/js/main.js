let table_data = [];
let activities = renderActivities();
for(let i=0 ; i < activities.length ; i++ ){
    let item = 
        {
            
            eventname : activities[i].event_id,
            date : activities[i].time_stamp,
            Activity: activities[i].activity
        }
        table_data.push(item);
}
// let table_data = [ 
//     {
//         eventname: "Beach-cleaning",
//         date:"Wed Jul 28 2021",
//         Activity: "You uploaded photos."
      
//     },
//     {
//         eventname: "Blood-donation",
//         date:"Wed Jul 28 2021",
//         Activity: "you shared a link."
        
//     },
//     {
//         eventname: "Blood-donation",
//         date:"Wed Jul 28 2021",
//         Activity: "You donated the event"
        
//     },
//     {
//         eventname: "Beach-cleaning",
//         date:"Wed Jul 28 2021",
//         Activity: "You shared a link"
       
//     },
//     {
//         eventname: "Blood-donation",
//         date:"Wed Jul 28 2021",
//         Activity: "you shared a link."
        
//     },
//     {
//         eventname: "sramadana campaign",
//         date:"Wed Jul 28 2021",
//         Activity: "you shared a link."
        
//     }
// ]

table_data.map(addDataRow)
function addDataRow(data,index){
    
    let tr = document.createElement('tr');
    let eventname = document.createElement('td');
    let eventlabel = document.createElement('div');
    eventlabel.setAttribute("class","data-label");
    eventlabel.innerText = "Event Name";
    eventname.appendChild(eventlabel);
    let eventdiv = document.createElement('div');
    eventdiv.setAttribute("class","data");
    let link = document.createElement('a');
    link.setAttribute('href', "#");
    link.innerText = data.eventname;
    eventdiv.appendChild(link);
    eventname.appendChild(eventdiv);
    tr.appendChild(eventname);


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
    activitydiv.innerText = data.Activity;
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