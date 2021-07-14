let table_data = [ 
    {
        eventname: "Beach-cleaning",
        date:"2/11/2021",
        Activity: "activity"
    },
    {
        eventname: "Blood-donation",
        date:"6/11/2021",
        Activity: "activity"
    },
    {
        eventname: "Blood-donation",
        date:"2/1/2021",
        Activity: "activity"
    },
    {
        eventname: "Beach-cleaning",
        date:"26/11/2021",
        Activity: "activity"
    },
    {
        eventname: "Blood-donation",
        date:"4/2/2022",
        Activity: "activity"
    },
    {
        eventname: "sramadana campaign",
        date:"5/1/2022",
        Activity: "activity"
    }
]

table_data.map(addDataRow)
function addDataRow(data,index){
    let tr = document.createElement('tr');
    let eventname = document.createElement('td');
    eventname.innerText = data.eventname;
    tr.appendChild(eventname);
    let date = document.createElement('td');
    date.innerText = data.date;
    tr.appendChild(date);
    let activity = document.createElement('td');
    activity.innerText = data.activity;
    tr.appendChild(activity);
    let action = document.createElement('td');
    action.innerHTML = '<button class="btn bg-red clr-white border-red" onclick="popupLoad()">Remove</button>';
    tr.appendChild(action);
    document.getElementById("table-body").appendChild(tr);
}

function onDelete(index) {
   
        table_data.splice(index,1);
        document.getElementById("table-body").innerHTML = "";
        table_data.map(addDataRow);
        popupLoad();

   
}