<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <title>Document</title>
</head>
<style>
    h1 {
        text-align: center;
        margin-top: 0;
    }

    h3 {
        margin: 0;
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
        overflow: visible;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fill, 275px);
        align-items: center;
        grid-gap: 1rem;
        justify-content: center;
        justify-items: center;
        padding: 0.4em;
        box-sizing: border-box;
    }

    .show-choices {
        height: 120px;
        transition: height, 0.3s linear;
    }

    .slidecontainer {
        width: 30%;
    }

    .choice-menu {
        display: none;
    }

    #sort,
    #date,
    #way,
    #mode,
    #search-type,
    #calendar-button,
    #map-button {
        margin: 0;
        margin-left: 0.5rem;
        width: 200px;
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
        min-height: 100%;
    }

    .grid {
        margin-top: 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fill, 250px);
        width: 100%;
        justify-content: center;
        gap: 2rem;
    }

    figure {
        min-height: 100px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        border-radius: 3px;
        margin: 0;
        min-width: 250px;
        width: 250px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    }

    figure p,
    h1,
    h2,
    h3 {
        font-family: Roboto, Arial, sans-serif;
    }

    figure p {
        margin: 0;
    }


    figure .content {
        position: relative;
    }

    figure .stats {
        top: 0;
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

    figure img {
        object-fit: cover;
        aspect-ratio: 4/2;
        max-width: 250px !important;
        height: 125px;
    }

    figure .about {
        font-size: smaller;
        white-space: normal;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
    }


    .grid div img {
        aspect-ratio: 4/2;
        width: 100%;
        border-radius: 8px;
    }

    #map {
        width: 450px;
        height: 400px;
    }

    .map-index {
        z-index: -1;
    }

    @media screen and (max-width:600px) {
        .show-choices {
            padding: 0.4em;
            height: 270px;
            transition: height, 0.3s linear;
        }
    }

    @media screen and (max-width:800px) {

        .grid {
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, 250px);
        }

        .choice-menu {
            display: none;
            display: flex;
            align-self: flex-end;
        }

        choices {
            height: 0;
            overflow: hidden;
            grid-gap: 0.2rem;
            padding: 0;
        }

        .show-choices {
            padding: 0.4em;
            height: 170px;
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

    <div class="homepage flex-col">
        <h1>Search to your choice</h1>
        <search class="flex-row-to-col flex-center border-round">
            <form action="/Search/view" class="flex-row-to-col flex-center">
                <div class="search-bar" style="height:fit-content">
                    <input type="search" class="form-ctrl clr-white" placeholder="Search" id="in-search" onkeyup="range='';">
                    <button type="submit" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
                </div>
                <div><button type="button" class="btn btn-solid" id="near-me" onclick="nearme()"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button></div>

            </form>
        </search>
        <!-- in page search bar end -->

        <!-- choice menu start -->
        <div class="choice-menu margin-md">
            <button class="btn-icon" onclick="choices()"><i class="fas fa-sliders-h" style="font-size:1.5em"></i></button>
        </div>

        <choices>
            <button type="button" id="map-button" class="btn btn-solid margin-md" onclick="toggleMap();resizeMap();">Search by location</button>
            <div class="flex-row flex-center margin-md">
                <input type="text" id="calendar-input" class="hidden" value="" onchange="search();">
                <div style="position: relative;">
                    <button type="button" class="btn" id="calendar-button" onclick="calendarShow();" style="border: 1px solid #ccc;color:black">Select Date &nbsp;<i class="far fa-calendar-alt"></i></button>
                    <div style="position: absolute; top:40px; left:-50px;" class="hidden" id="search-input-calendar">
                        <?php include "calendarInput.php" ?>
                    </div>
                </div>
            </div>

            <select class="form-ctrl" id="search-type" style="margin-left:0.5rem" onchange="search();searchType();">
                <option value="all" selected>All</option>
                <option value="event">Event</option>
                <option value="organization">Organization</option>
            </select>

            <select class="form-ctrl" id="mode" name="mode" style="margin-left:0.5rem" onchange="search();">
                <option value="" disabled selected>Select the mode</option>
                <option value="Physical">Physical</option>
                <option value="Virtual">Virtual</option>
                <option value="Physical & Virtual">Physical & Virtual</option>
            </select>


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
        </choices>

        <!-- choice menu end -->

        <!-- map start -->
        <div id="map-container" class="margin-md hidden" style="width: 100%;text-align:center;">
            <i class="fas fa-times margin-md" style="cursor: pointer; float:right;" onclick="toggleMap();"></i>
            <div id="map"></div>
        </div>
        <!-- map end -->

        <!-- search result event grids start -->
        <event-container class="flex-col flex-center">
            <div class="flex-row flex-center margin-lg width-100">
                <hr style="width: 30%;">Events
                <hr style="width: 30%;">
            </div>
            <events class="grid">
            </events>
            <button class="btn btn-solid margin-md" id="more-1">More</button>
        </event-container>
        <!-- search result event grids end -->

        <!-- search result Organizations grids start -->
        <organization-container class="flex-col flex-center">
            <div class="flex-row flex-center margin-lg width-100">
                <hr style="width: 30%;">Organizations
                <hr style="width: 30%;">
            </div>
            <organizations class="grid">
            </organizations>
            <button class="btn btn-solid margin-md" id="more-2">More</button>
        </organization-container>
        <!-- search result Organizations grids end -->


    </div>

</body>

<?php include "footer.php" ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSB7zeeAI3QC42UmxHEFqS715ulfPFASc&callback=initMap&libraries=&v=weekly" async></script>
<script>
    /* input calendar hide out of the calendar div*/
    document.addEventListener("click", (evt) => {
        let calendar = document.querySelector("#search-input-calendar");
        let calendar_button = document.getElementById("calendar-button");
        if (calendar !== evt.target && !calendar.contains(evt.target) && !calendar.classList.contains("hidden") && evt.target != calendar_button)
            calendarShow();
    });


    /* event and organisation more buttons */
    let event_list_offset = 0;
    document.getElementById("more-1").addEventListener("click", () => {
        event_list_offset = event_list_offset + 1;
        search("", "", "", "", event_list_offset);
    });

    let organization_list_offset = 0;
    document.getElementById("more-2").addEventListener("click", () => {
        organization_list_offset = organization_list_offset + 1;
        let name = document.getElementById("in-search").value;
        orgSearch(name, organization_list_offset);
    });


    /* chnage parameteres in search function */
    function searchType() {
        let mode = document.getElementById("mode");
        let sort = document.getElementById("sort");
        let way = document.getElementById("way");
        let date = document.getElementById("calendar-button");
        let map = document.getElementById("map-button");
        let search_type = document.getElementById("search-type");
        let event_container = document.querySelector("event-container");
        let organization_container = document.querySelector("organization-container");
        organization_container.classList.add("hidden");
        event_container.classList.add("hidden");

        if (search_type.value == "event" || search_type.value == "all") {
            if (search_type.value == "all")
                organization_container.classList.remove("hidden");
            event_container.classList.remove("hidden");
            mode.disabled = sort.disabled = way.disabled = date.disabled = map.disabled = false;
            map.style.opacity = date.style.opacity = "1";

        } else if (search_type.value == "organization") {
            organization_container.classList.remove("hidden");
            map.style.opacity = date.style.opacity = "0.5";
            mode.disabled = sort.disabled = way.disabled = date.disabled = map.disabled = true;
            let map_container = document.getElementById('map-container');
            if (!map_container.classList.contains("hidden"))
                toggleMap();
        }
    }

    /* input calendar show-hide */
    function calendarShow() {
        document.getElementById('search-input-calendar').classList.toggle('hidden');
        document.getElementById("map-container").classList.toggle('map-index');
        document.querySelector('.grid').classList.toggle('map-index');
    }

    /* input debouncer */
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

    /* element create dynamically */
    function createElementFromHTML(htmlString) {
        var div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }



    /* get user coordinates */
    function getCoordinates() {
        return new Promise(
            function(resolve, reject) {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            }
        );
    }

    /* event search ajax */
    async function search(latitude = "", longitude = "", range = "", is_virtual = "", offset = 0) {

        let parent_container = document.querySelector('events');
        var name = document.getElementById("in-search").value;
        var mode = document.getElementById("mode").value;
        var date = document.getElementById("calendar-input").value;
        var sort = document.getElementById("sort").value == "Sort by" ? "" : document.getElementById("sort").value;
        var way = document.getElementById("way").value == "Sort" ? "" : document.getElementById("way").value;
        let limit = 6;
        if (range || mode || date || sort || way) {
            document.getElementById("search-type").value = "event";
        }
        searchType();

        if (latitude == "" || longitude == "") {
            const position = await getCoordinates();
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
        }

        if (!document.getElementById('map-container').classList.contains("hidden")) {
            range = 40;
            is_virtual = 0;
        }


        if (document.getElementById("search-type").value == "event" || document.getElementById("search-type").value == "all") {
            $.ajax({
                url: "/Search/searchAll", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    name: name,
                    mode: mode,
                    latitude: latitude,
                    longitude: longitude,
                    distance: range,
                    start_date: date,
                    order_type: sort,
                    way: way,
                    <?php if ($registered_user || $guest_user) echo "status: ['published','ended']," ?>
                   /*  status: 'published', */
                    is_virtual: is_virtual,
                    offset: offset * limit,
                    limit: limit
                },

                success: function(result) {
                    let more_button = document.getElementById("more-1");
                    if (offset == 0) {
                        parent_container.innerHTML = "";
                        event_list_offset = 0;
                        more_button.classList.remove("hidden");
                    }
                    if (result.length != limit) {
                        more_button.classList.add("hidden");
                    } else {
                        more_button.classList.remove("hidden");
                    }
                    hideMarkers();
                    result.forEach(evn => {
                        let template = `
                        <figure onclick="location.href = '/Event/view?page=home&&event_id=${evn.event_id}' ">
                            <div class="content">
                                <div class="photo-container"><img src="${evn.cover_photo}" style="object-fit: cover;" alt="">
                                    <div class="stats">
                                    <div>
                                        <span>Volunteered ${evn.volunteered==null ? 0 : Math.round(evn.volunteer_percent)}%</span>
                                        <br>
                                        <span>Donations ${evn.dotaion_percent==null ? 0 : Math.round(evn.dotaion_percent)}%</span>
                                        <br>
                                        <span>Distance ${evn.distance==null ? " - " : Math.round(evn.distance)} KM</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="margin-md" style="margin-bottom:0;color:white;padding:4px;background-color:#F67280;border-radius:15px;text-align:center;font-size:0.85em;">Event</p>
                                <p class="margin-md" style="margin-bottom:0;"><b>${evn.status}</b></p>
                                <p class="margin-md" style="margin-bottom:0;"><b>${evn.event_name}</b></p>
                                <p class="margin-md about" style="margin-top:0">${evn.start_date==evn.end_date ? evn.end_date : 'From:'+evn.start_date+'<br>To:'+evn.end_date}</p>
                                <div class="flex-col margin-side-md" >
                                    <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                    <p>Donations</p>
                                    <p>${evn.donation_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                    </div>
                                    <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                    <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.donation_percent==null || evn.donation_percent<5) ? 5 :(evn.donation_percent>100? 100 : Math.round(evn.donation_percent)) }%;background-color:#FFB319;height:6px;"></div></div>
                                    <p>${evn.donation_percent==null ? 0 : Math.round(evn.donation_percent)}%</p>

                                    </div>
                                </div>
                                <div class="flex-col margin-side-md">
                                    <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                    <p>Volunteered</p>
                                    <p>${evn.volunteer_status==0 ? '<i class="fas fa-times fa-xs clr-red margin-side-md"></i>' : '<i class="fas fa-check fa-xs clr-green margin-side-md"></i>'}</p>
                                    </div>
                                    <div class ="flex-row" style="justify-content:space-between;align-items:center;">
                                    <div style="display:flex;align-items:center;position:relative;width:100%;"><div style="border-radius:6px;position:absolute;width:${(evn.volunteer_percent==null || evn.volunteer_percent<5) ? 5 : Math.round(evn.volunteer_percent)}%;background-color:#8236CB;height:6px;"></div></div>
                                    <p>${evn.volunteer_percent==null ? 0 : Math.round(evn.volunteer_percent)}%</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="margin-md about">${evn.about}</p>
                                </div>
                            </div>
                        </figure>
                        `;
                        parent_container.appendChild(createElementFromHTML(template));

                        /* if search has a longitude and latitude  display them on map*/

                        if (evn.longitude != null || evn.latitude != null) {

                            const infowindow = new google.maps.InfoWindow({
                                content: template,
                            });
                            let pos = {
                                lat: evn.latitude,
                                lng: evn.longitude
                            }
                            let marker = new google.maps.Marker({
                                position: pos,
                                map,
                                title: evn.event_name,
                            });

                            markers.push(marker);

                            marker.addListener("click", () => {
                                infowindow.open({
                                    anchor: marker,
                                    map,
                                    shouldFocus: false,
                                });
                            });
                        }
                    });
                }
            });
        }
        if (!(range || mode || date || sort || way) && (document.getElementById("search-type").value == "organization")) {
            //document.querySelector('Organizations').innerHTML = "";
            orgSearch(name);
        } else if (document.getElementById("search-type").value == "all" && document.getElementById('map-container').classList.contains("hidden"))
            orgSearch(name);

    }

    /* orgnaiztion search ajax */
    function orgSearch(name, offset = 0) {
        let limit = 6;
        $.ajax({
            url: "/Search/searchOrganisation", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                org_username: name,
                offset: offset * limit,
                limit: limit
            },
            success: function(result) {
                let parent_container = document.querySelector('Organizations');
                let more_button = document.getElementById("more-2");
                
                if (offset == 0) {
                    parent_container.innerHTML = "";
                    organization_list_offset = 0;
                    more_button.classList.remove("hidden");
                }

                if (result.length != limit) {
                    more_button.classList.add("hidden");
                } else {
                    more_button.classList.remove("hidden");
                }
                result.forEach(org => {
                    let template = `
                    <figure onclick="location.href = '/Organisation/view?org_id=${org.uid}&page=about' ">
                        <div class="content">
                            <div class="photo-container"><img src="${org.cover_pic}" style="object-fit: cover;" alt="">
                            <p class="margin-md" style="margin-bottom:0;color:white;padding:4px;background-color:#44c9d6;border-radius:15px;text-align:center;font-size:0.85em;">Organisation</p>
                            <p class="margin-md" style="margin-bottom:0;"><b>${org.username}</b></p>
                            <p class="margin-md about" style="margin-top:0">${org.email}</p>
                            <p class="margin-md about" style="margin-top:0">${org.contact_number}</p>
                            <div>
                                <p class="margin-md about">${org.about}</p>
                            </div>
                        </div>
                    </figure>
                    `;
                    parent_container.appendChild(createElementFromHTML(template));
                });

            }
        });
    }

    /* listen to search input text */
    document.getElementById("in-search").addEventListener('keyup', debounce(search, 500));

    /* toggle choice bar */
    function choices() {
        document.getElementsByTagName("choices")[0].classList.toggle("show-choices");
    }

    /* check url query parameters */
    let params = new URLSearchParams(location.search);
    let range = params.get("distance");
    document.getElementById("in-search").value = params.get("search");


    /* map initilzation */
    var map;
    var markers = [];

    async function initMap() {
        const position = await getCoordinates();
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        const current_location = {
            lat: latitude,
            lng: longitude
        };
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: current_location,
        });

        var custom_marker = {
            url: '/Public/assets/street-view-solid.svg',
            size: new google.maps.Size(100, 100),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 0),
        }
        new google.maps.Marker({
            position: current_location,
            draggable: false,
            map,
            title: "Your location",
            icon: custom_marker
        });

        map.addListener("center_changed", () => {
            let latlang = map.getCenter();
            search(latlang.lat(), latlang.lng(), 40, 0);
        });

        if (range) {
            document.getElementById("map-container").classList.toggle("hidden");
            resizeMap();
            search(latitude, longitude, 40, 0);

        } else {
            search(latitude, longitude);

        }
    }

    function hideMarkers() {
        setMapOnAll(null);
    }

    function deleteMarkers() {
        hideMarkers();
        markers = [];
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function resizeMap() {
        document.getElementById("map").style.width = parseInt(document.getElementById("map-container").offsetWidth) + "px";
    }

    async function toggleMap() {
        const position = await getCoordinates();
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        let map = document.getElementById('map-container');
        if (map.classList.contains("hidden")) {
            document.getElementById("mode").options[0].selected = true;
            document.getElementById("search-type").value = "event";
            searchType();
            map.classList.toggle("hidden");
            debounce(search(latitude, longitude, 40, 0), 1000);
        } else {
            document.getElementById("search-type").options[0].selected = true;
            searchType();
            map.classList.toggle("hidden");
            search(latitude, longitude);
        }
        resizeMap();
    }

    window.addEventListener("resize", resizeMap);
    window.onload = resizeMap;
</script>


</html>