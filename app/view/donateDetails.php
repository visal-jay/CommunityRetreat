<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/assets/newstyles.css">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <title>Donation details</title>
</head>

<style>

    table{
        width: 100%;
        table-layout: fixed;
    }

    table, th, td {
        text-align: center;
        padding: 7px 10px 20px;
    }

    h1{
        color: #16c79a;
        text-align: center;
    }
    
    .donation-details-btn{
        text-align: center;
        margin: 25px;
    }

@media screen and (max-width:768px) {

    /*.event-table thead{
        display: none;
    }

    .event-table, .event-table tbody, .event-table tr{
        display: block;
        width: 100%;

    }

    .event-table td{
        display:flex;
        width: 100%;
        flex-direction: row;
        justify-content: space-between ;
        padding: 10px 10px 10px;
    }

    .event-table tr{
        margin-bottom: 15px;
        border-radius: 8px;
        box-shadow: 0px 0px 0px 1px silver;
        border-top: 3px solid #16c79a;
    }

    .event-table td:before{    
        position: absolute;
        left:0;
        width:100%;
        padding-left: 15px;
        font-weight: 600;
        font-size: 14px;
        text-align:left;
        
    }*/
}

</style>

<body>
<div class="background">
    <h1>Donation Details</h1>
    <div class="event-table">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th> 
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>J.K.Wijayathilake</td>
                    <td>2020.10.21</td>
                    <td>rs.100000</td>
                </tr>
                <tr>
                    <td>M.D.Karunarathne</td>
                    <td>2020.10.25</td>
                    <td>rs.150000</td>
                </tr>
                <tr>
                    <td>P.V.Kumarasinghe</td>
                    <td>2020.11.02</td>
                    <td>rs.120000</td>
                </tr>
                <tr>
                    <td>H.N.Hewawithrane</td>
                    <td>2020.11.05</td>
                    <td>rs.200000</td>
                </tr>
                <tr>
                    <td>R.S.Thilakawardhane</td>
                    <td>2020.11.10</td>
                    <td>rs.1000000</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="donation-details-btn">
        <button class="btn btn-md btn-solid">Full donation details</button>
    </div>
</div>
</body>
</html>