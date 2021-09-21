<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<style>
    .calender-input-active {
        background-color: #16c79a;
        color: white;
    }

    .calendar-container {
        width: fit-content;
        background-color: white;
        border-radius: 8px;
        z-index: 1000000;
        padding: 1rem;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 30px [col-start]);
        grid-template-rows: repeat(7, 30px [col-start]);
        width: fit-content;
        font-family: sans-serif;
    }

    .calendar-grid div {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
    }

    .current-date {
        background-color: grey;
        border-radius: 100%;
    }

    .end-space,
    .start-space {
        text-align: center;
        vertical-align: center;
        background-color: #e4e0e0;
    }
</style>

<body>
    <div class="calendar-container">
        <!--  <input type="text" id="calendar-input" class="hidden" value=""> -->
        <div class="flex-row flex-center margin-md">
            <div onclick="createDates(year,--month);">
                <i class="fas fa-arrow-left fas-xs margin-side-md"></i>
            </div>
            <div class="calendar-month-year margin-side-md"></div>
            <div onclick="createDates(year,++month);">
                <i class="fas fa-arrow-right fas-xs margin-side-md"></i>
            </div>
        </div>
        <div class="calendar-grid"></div>
        <button type="button" class="btn clr-white bg-red border-red btn-small" onclick="clearInputDates();">clear</button>

    </div>

</body>

<script>
    function createElementFromHTML(htmlString) {
        var div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    let date = new Date();
    let current_year = date.getFullYear();
    let current_month = date.getMonth();
    let current_date = date.getDate();
    let current_day = date.getDay();

    let calendar_month_year = document.querySelector(".calendar-month-year");
    let calendar = document.querySelector(".calendar-grid");

    let days = ["M", "T", "W", "T", "F", "S", "S"];
    let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]

    let year = current_year;
    let month = current_month;
    console.log(year, month, current_date);

    selected_days = [];

    createDates(year, month);

    function clearInputDates(){
        console.log("sdfsdf");
        selected_days = [];
        createDates(year, month);
        document.getElementById("calendar-input").value = "";
        search();
    }

    function setCalendarInput(date) {
        event.target.classList.toggle("calender-input-active");
        var input_date = String(year) + "-" + String(month + 1) + "-" + date;
        if (selected_days.includes(input_date))
            selected_days = selected_days.filter(function(e) {
                return e !== input_date
            });
        else
            selected_days.push(input_date);
        document.getElementById("calendar-input").value = selected_days.join(",");
        console.log(document.getElementById("calendar-input").value);
        search();
    }

    function createDates(year, month) {
        let input_date = new Date(year, month, 0);
        let input_month_days = (new Date(year, month + 1, 0)).getDate();
        let previous_month_days = (new Date(year, month - 1, 0)).getDate();
        let start_space = input_date.getDay();
        let end_space = 6 - ((input_month_days - (7 - input_date.getDay() + 1)) % 7);
        let temp = 1;


        if (month > 11) {
            month = (month % 11) - 1;
            year++;
        }
        calendar_month_year.innerHTML = "";
        calendar.innerHTML = "";

        calendar_month_year.appendChild(createElementFromHTML("<div>" + months[month] + " " + year + "</div>"));
        days.forEach((item) => calendar.appendChild(createElementFromHTML("<div>" + item + "</div>")));


        for (i = 1; i <= start_space + input_month_days + end_space; i++) {
            if (i <= start_space) {
                var temp_date = (previous_month_days - (start_space - i));
                calendar.appendChild(createElementFromHTML("<div class='start-space'>" + String(temp_date).padStart(2, '0') + "</div>"));
            } else if (i <= start_space + input_month_days) {
                var temp_date = (i - start_space);
                if (selected_days.includes(String(year) + "-" + String(month + 1) + "-" + temp_date))
                    calendar.appendChild(createElementFromHTML("<div class='calender-input-active' onclick='setCalendarInput(" + temp_date + ");'>" + String(temp_date).padStart(2, '0') + "</div>"));
                else
                    calendar.appendChild(createElementFromHTML("<div onclick='setCalendarInput(" + temp_date + ");'>" + String(temp_date).padStart(2, '0') + "</div>"));
            } else if (i <= start_space + input_month_days + end_space) {
                calendar.appendChild(createElementFromHTML("<div class='end-space'>" + String(temp).padStart(2, '0') + "</div>"));
                temp++;
            }
        }
    }

    

</script>

</html>