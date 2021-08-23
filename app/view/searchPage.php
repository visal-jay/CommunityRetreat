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

    p {
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

    .choice-menu {
        display: none;
    }

    #sort,#date {
        margin: 0;
    }

    search {
        width: 100%;
        max-width: 100%;
        background-color: #0A1931;
        padding: 2rem;
        box-sizing: border-box;
    }


    input[type=search] {
        width: 100px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    search input[type=search] {
        width: 90%;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    search input[type=search]:focus {
        width: 100%;
    }

    input[type=search]:focus {
        width: 200px;
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
            height: 150px;
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
            <form action="/action_page.html" class="search-bar" style="height:fit-content">
                <input type="search" class="form-ctrl" placeholder="Search">
                <button type="" class="btn-icon clr-green "><i class=" fa fa-search "> </i></button>
            </form>
            <button class="btn btn-solid" id="near-me"><i class="fas fa-map-marker-alt"></i>&nbsp;Near me</button>
        </search>

        <div class="choice-menu margin-md">
            <button class="btn-icon" onclick="choices()"><i class="fas fa-sliders-h" style="font-size:1.5em"></i></button>
        </div>

        <choices class="flex-row-to-col flex-space">
            <div class="slidecontainer flex-row flex-center">
                <label for="myRange">Distance: </label>
                <input type="range" min="0" max="100" value="0" class="slider" id="myRange">
                <p><span id="demo"></span> km</p>
            </div>
            <div class="flex-row flex-center">
                <label>Date: &nbsp; </label>
                <input type="date" class="form-ctrl" id="date">
            </div>
            <div class="flex-row flex-center margin-md">
                <select id="sort" class="form-ctrl">
                    <option selected disabled>Sort by</option>
                    <option value="distance">Distance</option>
                    <option value="date">Date</option>
                    <option value="volunteer">Volunteers</option>
                    <option value="donations">Donations</option>
                </select>
            </div>
        </choices>

        <events class="grid">
            <figure class="item bg-green">
                <div class="content">
                    <div class="photo-container flex flex-center"><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt=""></div>
                    <p class="margin-md" style="color:white;">Manuka Dewanarayana</p>
                </div>
            </figure>
            <figure class="item bg-green">
                <div class="content">
                <div class="photo-container flex flex-center content"><img src="/Public/assets/photo.jpeg" style="object-fit: cover;" alt=""></div>

                    <p class="margin-md" style="color:white;">Manuka Dewanarayana</p>
                </div>
            </figure>
            <figure class="item bg-green">
                <div class="content">
                    <div class="photo-container flex flex-center"><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt=""></div>
                    <p class="margin-md" style="color:white;">Manuka Dewanarayana</p>
                </div>
            </figure>
            <figure class="item bg-green">
                <div class="content">
                    <div class="photo-container flex flex-center"><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt=""></div>
                    <p class="margin-md" style="color:white;">Manusdaskdml;asdl;as;ldka Dewanarayana</p>
                </div>
            </figure>

            <figure class="item bg-green">
                <div class="content">
                    <div class="photo-container flex flex-center"><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt=""></div>
                    <p class="margin-md" style="color:white;">Manusdaskdml;asdl;as;ldka Dewanarayana</p>
                </div>
            </figure>

            <figure class="item bg-green">
                <div class="content">
                    <div class="photo-container flex flex-center"><img src="/Public/assets/mountains.jfif" style="object-fit: cover;" alt=""></div>
                    <p class="margin-md" style="color:white;">Manusdaskdml;asdl;as;ldka Dewanarayana</p>
                </div>
            </figure>
        </events>
    </div>

</body>
<script>
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