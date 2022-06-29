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

<h1>Employee Monthly Salary Details</h1>

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
        <th>Employee Details</th>
        <th>Employee Data</th>
    </tr>

    <tr>
        <td>1</td>
        <td>Employee Name</td>
        <td>{{$selected_employee['userClass']['name']}}</td>
    </tr>


    <tr>
        <td>2</td>
        <td>ID_NO</td>
        <td>{{$selected_employee['userClass']['id_no']}}</td>
    </tr>


    <tr>
        <td>3</td>
        <td>Salary</td>
        <td>{{$selected_employee['userClass']['salary']}}</td>
    </tr>

    <tr>
        <td>1</td>
        <td>Month</td>
        <td>{{$date}}</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Number of Absents</td>
        <td>{{$count_absent}}</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Amount Payable</td>
        <td>{{
            $selected_employee['userClass']['salary']- ($selected_employee['userClass']['salary'])/30 * $count_absent

          }}</td>
    </tr>

</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
