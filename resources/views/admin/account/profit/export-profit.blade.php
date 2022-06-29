<!DOCTYPE html>
<html lang="">
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        #fees {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #fees td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #fees tr:nth-child(even){background-color: #f2f2f2;}

        #fees tr:hover {background-color: #ddd;}

        #fees th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>

<h1>Monthly Profit  - BreakDown</h1>

<table id="customers">

    <tr>
        {{--        <td>--}}
        {{--            <img src="{{(asset('images/logo.png'))}}" style="height: 90px; width: 90px" alt="">--}}
        {{--        </td>--}}
        <td><h3>Contact Details</h3>
            <p>Email: support@schoolmasoft.com</p>
            <p>Tel: 233559099224</p>
            <p>Address: Paa Grant Street, UX 45493</p>
        </td>
    </tr>

</table>

<table id="customers">
    <tr>
        <td colspan="2" class="text-center" style="text-align: center">
            <h4>  Reporting Date: {{$start_date}} to {{$end_date}}</h4>
        </td>
    </tr>
    <tr>
        <th>SL</th>
        <th>Expenditures</th>
        <th>Cost</th>
    </tr>

    <tr>
        <td>1</td>
        <td>Total Student Fees</td>
        <td>{{$student_fees}}</td>
    </tr>

    <tr>
        <td>2</td>
        <td>Total Salary</td>
        <td>{{$employee_payment_fees}}</td>
    </tr>

    <tr>
        <td>3</td>
        <td>Other Costs</td>
        <td>{{$other_costs}}</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Monthly Profit</td>
        <td>{{$monthly_profit}}</td>
    </tr>




</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
