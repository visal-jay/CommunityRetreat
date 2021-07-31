let table_data = [
    {
        eventname : "Beach cleaning campaign",
        position : "Volunteer"
    },
    {
        eventname : "Blood donation programme",
        position : "Volunteer/Moderator"
    },
    {
        eventname : "Sramadana campaign",
        position : "Treasurer"
    },
    {
        eventname : "Beach cleaning campaign",
        position : "Moderator"
    },
   
]

table_data.map(addDataTable);

function addDataTable(data){
    let tablecontainer = document.createElement('div');
    tablecontainer.setAttribute("class","card-container");
    tablecontainer.setAttribute("id","card");
    let table = document.createElement("table");
    table.setAttribute("class","adminstrative-table");
    let thead = document.createElement("thead");
    

    let th1 = document.createElement("th");
    th1.innerText = "Event name";
    thead.appendChild(th1);
    let th2 = document.createElement("th");
    th2.innerText = "Position";
    thead.appendChild(th2);
    table.appendChild(thead);
    let tbody = document.createElement("tbody");

    let tr = document.createElement("tr");

    let eventname = document.createElement("td");

    let datallabel1 = document.createElement("div");
    datallabel1.setAttribute("class","datalabel-eventname");
    datallabel1.innerText = "Event name :";
    eventname.appendChild(datallabel1);

    let eventnamediv= document.createElement("div");
    eventnamediv.setAttribute("class","eventnamediv")
    let link = document.createElement('a');
    link.setAttribute('href', "#");
    link.innerText = data.eventname;
    eventnamediv.appendChild(link);
    eventnamediv.setAttribute("class","eventname");
    eventname.appendChild(eventnamediv);
    tr.appendChild(eventname);

    let position = document.createElement("td");
    let datallabel2 = document.createElement("div");
    datallabel2.setAttribute("class","datalabe2-position");
    datallabel2.innerText = "Position:\t";
    position.appendChild(datallabel2);

    let positiondiv =  document.createElement("div");
    positiondiv.setAttribute("class","positiondiv")
    positiondiv.innerText = data.position;
    position.appendChild(positiondiv);
    tr.appendChild(position);

    tbody.appendChild(tr);

    table.appendChild(tbody);

    tablecontainer.appendChild(table);
    document.getElementById("table-container").appendChild(tablecontainer);




    




}