<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Document</title>
</head>
<style>
    .grid {
        margin-top: 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(185px, 1fr));
        gap: 1rem;
    }

    figure {
        margin: 0;
        display: grid;
        grid-template-rows: 1fr auto;
    }

    h1 {
        text-align: center;
        margin-top: 0;
    }

    h3 {
        margin: 0;
    }

    figure p {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .flex-row-to-col {
        display: flex;
        flex-direction: row;
    }

    choices {
        margin-top: 1rem;
        width: 100%;
        background: #EEEEEE;
        border-radius: 8px;
        transition: height, 0.3s linear;
    }

    .show-choices {
        height: 70px;
        transition: height, 0.3s linear;
    }

    .slidecontainer {
        width: 30%;
    }

    .slider {
        -webkit-appearance: none;
        border-radius: 8px;
        width: 100%;
        height: 0.5rem;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        border-radius: 50%;
        width: 1rem;
        height: 1rem;
        background: #04AA6D;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        background: #04AA6D;
        cursor: pointer;
    }

    .slidecontainer p {
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .choice-menu {
        display: none;
    }

    #sort,
    #date,
    #way,
    #mode {
        margin: 0;
        margin-left: 0.5rem;
    }

    search {
        width: 100%;
        max-width: 100%;
        background-color: #0A1931;
        padding: 2rem;
        box-sizing: border-box;
    }



    search input[type=search] {
        width: 90%;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    search input[type=search]:focus {
        width: 100%;
    }



    .homepage {
        margin: 0 auto;
        width: 80%;
    }

    figure {
        overflow: hidden;
        border-radius: 8px;
        margin: 0;
        display: grid;
        grid-template-rows: 1fr auto;

    }

    figure .content {
        position: relative;
    }

    figure .stats {
        position: absolute;
        width: 100%;
        height: 100% !important;
        background-color: #000000aa;
        color: white;
        display: none;
        text-align: center;
        align-items: center !important;
        justify-content: center;
    }

    .photo-container {
        position: relative;
    }

    figure:hover .stats {
        display: flex;

    }

    figure>img {

        grid-row: 1 / -1;
        grid-column: 1;
    }

    .grid div {
        text-overflow: ellipsis;
        overflow: hidden;
        align-items: baseline;
        height: fit-content;
        border-radius: 8px;
        transition: all .4s ease-in-out;
    }

    .grid div img {
        aspect-ratio: 4/2;
        width: 100%;
        border-radius: 8px;
    }

    @media screen and (max-width:767px) {

        .slider {
            width: auto;
        }

        .grid {
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }

        .choice-menu {
            display: none;
            display: flex;
            align-self: flex-end;
        }

        choices {
            height: 0;
            overflow: hidden;

        }

        .show-choices {
            height: 220px;
            transition: height, 0.3s linear;
        }

        .slidecontainer {
            width: 80%;
        }

        h1 {
            font-size: 1.5rem;
        }

        .flex-row-to-col {
            align-items: flex-start;
            justify-content: left;
            flex-direction: column;
        }

        #near-me {
            margin: 10px;
        }
    }
</style>
<?php include "nav.php" ?>

<body>
    <div class="homepage flex-col flex-center">
        <h1>Search to your choice</h1>
        <search class="flex-row-to-col flex-center border-round">
            <form action="/search/view" class="flex-row-to-col flex-center">
                <div class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl clr-white" placeholder="Search" id="in-search">
                    <button type="submit" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </div>
                <div><button type="button" class="btn btn-solid" id="near-me" onclick="nearme()"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button></div>

            </form>
        </search>

        <div class="choice-menu margin-md">
            <button class="btn-icon" onclick="choices()"><i class="fas fa-sliders-h" style="font-size:1.5em"></i></button>
        </div>

        <choices class="flex-col">
            <div class="flex-row-to-col  flex-space">
                <div class="search-bar">
                    <input type="search" class="form-ctrl" id="city" placeholder="Search by location">
                </div>
                <div class="slidecontainer flex-row flex-center">
                    <label for="myRange">Distance: </label>
                    <input type="range" min="0" max="100" value="0" class="slider" id="myRange" onchange="search();">
                    <p><span id="demo"></span> km</p>
                </div>
                <div class="flex-row flex-center">
                    <label>Date: &nbsp; </label>
                    <input type="date" class="form-ctrl" id="date" onchange="search();">
                </div>
            </div>
            <div class="flex-row-to-col flex-center">
                <div class="flex-row flex-center margin-md">
                    <select id="sort" class="form-ctrl" onchange="search();">
                        <option selected disabled>Sort by</option>
                        <option value=distance>Distance</option>
                        <option value=start_date>Date</option>
                        <option value=volunteered>Volunteers</option>
                        <option value=donations>Donations</option>
                    </select>
                    <select id="way" class="form-ctrl" style="margin-left:0.5rem" onchange="search();">
                        <option selected disabled>Sort</option>
                        <option value=ASC>Ascending</option>
                        <option value=DESC>Descending</option>
                    </select>
                </div>
                <select class="form-ctrl" id="mode" name="mode" style="margin-left:0.5rem" required onchange="search();">
                    <option value="" disabled selected>Select the mode of the event</option>
                    <option value="Physical">Physical</option>
                    <option value="Virtual">Virtual</option>
                    <option value="Physical & Virtual">Physical & Virtual</option>
                </select>
            </div>
        </choices>

        <events class="grid">
        </events>
    </div>

</body>
<script>
    const debounce = (func, delay) => {
        let debounceTimer
        return function() {
            const context = this
            const args = arguments
            clearTimeout(debounceTimer)
            debounceTimer
                = setTimeout(() => func.apply(context, args), delay)
        }
    }

    function createElementFromHTML(htmlString) {
        var div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    let params = new URLSearchParams(location.search);
    /*var latitude = pos.get("latitude");
    var longitude = pos.get("longitude");*/
    var range = params.get("distance");
    document.getElementById("in-search").value = params.get("search");


    function getCoordinates() {
        return new Promise(
            function(resolve, reject) {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            }
        );
    }

    async function search() {

        const position = await getCoordinates();
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;

        var city = (document.getElementById("city").value);
        //name = document.getElementById("in-search").value == "" ? document.getElementById("in-search").value : name;
        var name = document.getElementById("in-search").value;
        var mode = (document.getElementById("mode").value);
        range = document.getElementById("myRange").value == "" ? document.getElementById("myRange").value : range;
        var date = document.getElementById("date").value;
        var sort = document.getElementById("sort").value == "Sort by" ? "" : document.getElementById("sort").value;
        var way = document.getElementById("way").value == "Sort" ? "" : document.getElementById("way").value;


        console.log(longitude);
        $.ajax({
            url: "/search/searchAll", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                name: name,
                mode: mode,
                latitude: latitude,
                longitude: longitude,
                city: city,
                distance: range,
                start_date: date,
                order_type: sort,
                way: way,
            },
            success: function(result) {
                console.log(result);
                let parent_container = document.querySelector('events');
                parent_container.innerHTML = "";
                result.forEach(evn => {
                    let template = `
                        <figure class="item bg-green" onclick="location.href = '/event/view?page=about&&event_id=${evn.event_id}' ">
                            <div class="content">
                                <div class="photo-container flex flex-center"><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt="">
                                    <div class="stats">
                                    <div>
                                        <span>Volunteered ${evn.volunteered==null ? 0 : Math.round(evn.volunteer_percent)}%</span>
                                        <br>
                                        <span>Donations ${evn.dotaion_percent==null ? 0 : Math.round(evn.dotaion_percent)}%</span>
                                        <br>
                                        <span>Distance ${evn.distance==null ? "- " : Math.round(evn.distance)} KM</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="margin-md" style="color:white;">${evn.event_name}</p>
                            </div>
                        </figure>
                        `;
                    parent_container.appendChild(createElementFromHTML(template));
                });

            }
        });
    }

    window.onload = search;
    //console.log()
    document.getElementById("city").addEventListener('keyup', debounce(search, 500));
    document.getElementById("in-search").addEventListener('keyup', debounce(search, 500));


    function choices() {
        document.getElementsByTagName("choices")[0].classList.toggle("show-choices");
    }

    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }


</script>


</html>