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

<h2>Attendance Report for <strong>{{$all_data[0]['userClass']['name']}}</strong></h2>

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
<h3>Employe Details</h3>
<table id="customers">
    <tr>
        <td>Employee ID</td>
        <td>{{$all_data['0']['userClass']['id_no']}}</td>
    </tr>
    <tr>
        <td>Employee Name</td>
        <td>{{$all_data['0']['userClass']['name']}}</td>
    </tr>
    <tr>
        <td>Designation</td>
        <td>{{$all_data['0']['userClass']['DesignationClass']['name']}}</td>
    </tr>
</table>
<br>
<table id="customers">
    <thead>
    <tr>
        <th>Date</th>
        <th>Attendance Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_data as $key=> $attendance_data)
     <tr>
         <td>{{$attendance_data->date}}</td>
         <td>{{$attendance_data->attendance_status}}</td>
     </tr>
     @endforeach
    </tbody>
</table>

<br>
<hr style="border: 1px solid #368e10">
<h3>Attendance Summary <span>{{$date}}</span></h3>

<table id="customers">

    <tr>
        <td>No. Of Attendance Taken</td>
        <td>{{$number_of_attendance}}</td>
    </tr>
    <tr>
        <td>No. Of Absents</td>
        <td>{{$number_of_absents}}</td>
    </tr>
    <tr>
        <td>No. of Presents</td>
        <td>{{$number_of_presents}}</td>
    </tr>

    <tr>
        <td>No. of Leaves</td>
        <td>{{$number_of_leaves}}</td>
    </tr>
</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
