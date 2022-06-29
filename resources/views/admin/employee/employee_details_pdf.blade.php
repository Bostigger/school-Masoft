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

<h1>Employee Details</h1>

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
        <td>{{$selected_employee->name}}</td>
    </tr>

    <tr>
        <td>2</td>
        <td>Father's Name</td>
        <td>{{$selected_employee->fname}}</td>
    </tr>

    <tr>
        <td>3</td>
        <td>Mother's Name</td>
        <td>{{$selected_employee->mname}}</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Mobile Number</td>
        <td>{{$selected_employee->mobile}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Address</td>
        <td>{{$selected_employee->address}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Gender</td>
        <td>{{$selected_employee->gender}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Id No</td>
        <td>{{$selected_employee->id_no}}</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Religion</td>
        <td>{{$selected_employee->religion}}</td>
    </tr>
    <tr>
        <td>7</td>
        <td>Date of Birth</td>
        <td>{{$selected_employee->dob}}</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Join Date</td>
        <td>{{$selected_employee->join_date}}</td>
    </tr>
    <tr>
        <td>9</td>
        <td>Salary</td>
        <td>{{$selected_employee->salary}}</td>
    </tr>
    <tr>
        <td>10</td>
        <td>Position</td>
        <td>{{$selected_employee['DesignationClass']['name']}}</td>
    </tr>


</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
