"use strict";

const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
    
];

let calender_data2 = [];

let event_details = renderEvents();



for(let i=0 ; i<event_details.length ; i++ ){

     calender_data2.push( [
         {
             
             date: event_details[i][0].day,
             month: event_details[i][0].month,
             event: [
                 {
                    event_id :  event_details[i][0].event_id,
                     eventname:  event_details[i][0].event_name,
                     organization:  event_details[i][0].organisation_username
                 }
             ]
         }
     ]);
}



// let calender_data2 = [
//     {
//         date: 12,
//         month: 9,
//         event :[
//             {
//                 eventname : "<?= $array[0][event_name]?>", 
//                 organization : "AIESEC in University of Colombo"
//             },
//             {
//                 eventname : "Blood donation campaign",
//                 organization : "GAVEL Club of University of Colombo"
//             }

//         ]
//     },
//     {
//         date: 20,
//         month: 9,
//         event :[
//             {
//                 eventname : "Hello", 
//                 organization :" Leo club"
//             },
           
//         ]
//     },
//     {
//         date: 26,
//         month: 9,
//         event :[
//             {
//                 eventname : "Beach cleaning campaign", 
//                 organization : "AIESEC in University of Colombo"
//             },
//             {
//                 eventname : "Blood donation campaign",
//                 organization : "GAVEL Club of University of Colombo"
//             },
//             {
//                 eventname : "sramadana campaign",
//                 organization : "Leo Club of Nilwala"
//             }


//         ]
//     },
   


// ]


const date = new Date();



function popupLoad(index){

    document.querySelector('.event-items').innerHTML ="";
   
    
    for(let eventIndex=0; eventIndex< calender_data2[index][0].event.length;eventIndex++){

   
        document.querySelector('.date-event-popup p').innerHTML =  months[calender_data2[index][0].month-1] + " " +calender_data2[index][0].date +" "+date.getFullYear();

        let eventcontainer = document.createElement('div');
        eventcontainer.setAttribute("class","event-container");

        let eventicondiv = document.createElement('div');
        eventicondiv.setAttribute("class","flag-container");

        let i = document.createElement('i');
        i.setAttribute("class","far fa-flag fa-1x clr-green");
        eventicondiv.appendChild(i);

        eventcontainer.appendChild(eventicondiv);

        let eventdetailsdiv = document.createElement('div');
        eventdetailsdiv.setAttribute("class","event-details-container");

        let Eventname = document.createElement('h4');
        let eventlink = document.createElement('a');
        eventlink.setAttribute("href","/event/view?page=about&&event_id="+calender_data2[index][0].event[eventIndex].event_id);
        eventlink.innerHTML = calender_data2[index][0].event[eventIndex].eventname;
        Eventname.appendChild(eventlink);
        eventdetailsdiv.appendChild(Eventname);

        let Organizationname = document.createElement('p5');
        Organizationname.innerHTML = "Event By " + calender_data2[index][0].event[eventIndex].organization;
        eventdetailsdiv.appendChild(Organizationname);

        eventcontainer.appendChild(eventdetailsdiv);
        document.querySelector('.event-items').appendChild(eventcontainer);

    
    }
    var popup = document.querySelector('.event-popup-container');
    var body = document.querySelector('.body');
    body.classList.toggle("overflow");
    popup.classList.toggle("pop-up-load");
}



const renderCalender = ()=>{

    
    
    date.setDate(1);

    const monthdays = document.querySelector(".days");

    const lastday = new Date(date.getFullYear(),date.getMonth()+1,0).getDate();

    const firstdayindex = date.getDay();

    const lastdayindex = new Date(date.getFullYear(),date.getMonth()+1,0).getDay();

    //const nextdays = 7 -lastdayindex -1;
   



    document.querySelector('.date h1').innerHTML = months[date.getMonth()];

    
    

    document.querySelector('.date p').innerHTML = new Date().toDateString();

    let days = "";

    for(let j = firstdayindex;j>0;j--){
        days += '<div></div>';
    }

    
    for( let i=1; i<=lastday;i++){
        
        const index  = calender_data2[1].findIndex((day) => day.date == i&& date.getMonth()==day.month-1);

       
        if(( i=== new Date().getDate()&& date.getMonth() === new Date().getMonth())&& (index != -1)){
            days += `<div class="event-days" id="i" onclick="popupLoad('${index}')">${i}</div>`;
        }  
        else if( i=== new Date().getDate()&& date.getMonth() === new Date().getMonth()){
            days += '<div class = "today" id ="'+i+ '" onClick="alert()" >'+i+'</div>';
         } 
        
        else if (index != -1){
            days += `<div class="event-days" id="i" onclick="popupLoad('${index}')">${i}</div>`;
        }
 
        else{
            days += '<div id = ' + i + '>'+i+'</div>';
        }
       
    }

    
    /*for(let k=1;k<=nextdays;k++){
         days += '<div>'+k+'</div>';
   
    }*/
    monthdays.innerHTML = days;
}

document.querySelector(".prev").addEventListener('click',()=>{
    date.setMonth(date.getMonth()-1);
    renderCalender();
});
document.querySelector(".next").addEventListener('click',()=>{
    date.setMonth(date.getMonth()+1);
    renderCalender();


});




function popupHide(){
    var popup = document.querySelector('.event-popup-container');
    var body = document.querySelector('.body');
    body.classList.toggle("overflow");
    popup.classList.toggle("pop-up-load");
}

function successCall(result){
    var event_details = JSON.parse(result);
    console.log(event_details);
    return event_details;
}

renderCalender();

function renderEvents(){

     var event_details="";

    $.ajax({
        async:false,
        url: "ajax/Calendar/getCalendarDetails",
        type: "post",
        success : function(result){

            event_details = JSON.parse(result);
           
       },

    });
    return event_details;

}



 
