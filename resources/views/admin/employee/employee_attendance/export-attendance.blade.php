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
    </style>
</head>
<body>

<h1>Attendance Details <strong>{{$selected_date[0]['date']}}</strong></h1>

<table id="customers">

    <tr>
        <td><h3>SchoolMasoft  </h3></td>
        <td><h3>Contact Details</h3>
            <p>Email: support@schoolmasoft.com</p>
            <p>Tel: 233559099224</p>
            <p>Address: Paa Grant Street, UX 45493</p>
        </td>
    </tr>

</table>

<table id="customers">
    <tr>
        <th>SL</th>
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Attendance Status</th>
    </tr>

   @foreach($selected_date as $key=> $date)
    <tr>
        <td>5</td>
        <td>{{$date['userClass']['id_no']}}</td>
        <td>{{$date['userClass']['name']}}</td>
        <td>{{$date->attendance_status}}</td>
    </tr>
    @endforeach


</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
