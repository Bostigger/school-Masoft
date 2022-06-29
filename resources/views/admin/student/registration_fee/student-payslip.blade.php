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

<h1>Student Details</h1>

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
        <th>Student Details</th>
        <th>Student Data</th>
    </tr>

    <tr>
        <td>1</td>
        <td>Student Name</td>
        <td>{{$selected_student['userClass']['name']}}</td>
    </tr>

    <tr>
        <td>2</td>
        <td>Father's Name</td>
        <td>{{$selected_student['userClass']['fname']}}</td>
    </tr>

    <tr>
        <td>3</td>
        <td>Mother's Name</td>
        <td>{{$selected_student['userClass']['mname']}}</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Mobile Number</td>
        <td>{{$selected_student['userClass']['mobile']}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Address</td>
        <td>{{$selected_student['userClass']['address']}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Gender</td>
        <td>{{$selected_student['userClass']['gender']}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Id No</td>
        <td>{{$selected_student['userClass']['id_no']}}</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Religion</td>
        <td>{{$selected_student['userClass']['religion']}}</td>
    </tr>
    <tr>
        <td>7</td>
        <td>Date of Birth</td>
        <td>{{$selected_student['userClass']['dob']}}</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Student Year</td>
        <td>{{$selected_student['studentYear']['name']}}</td>
    </tr>
    <tr>
        <td>9</td>
        <td>Student Class</td>
        <td>{{$selected_student['studentClass']['name']}}</td>
    </tr>



</table>
<h2>Student Fee Details</h2><br>
<table id="fees">
    <tr>
        <td>10</td>
        <td>Registration Amount</td>
        <td>{{$registration_fee->fee_amount }}</td>
    </tr>

    <tr>
        <td>11</td>
        <td>Student Discount</td>
        <td>{{$selected_student['studentDiscount']['discount_amount'].'%'}}</td>
    </tr>
    <tr>
        <td>12</td>
        <td>Amount Payable</td>
        <td>{{$registration_fee->fee_amount - ($registration_fee->fee_amount * ($selected_student['studentDiscount']['discount_amount'])/100) .'$' }}</td>

    </tr>
</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
