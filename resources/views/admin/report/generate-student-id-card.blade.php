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

<h2>STUDENT ID'S</h2>

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
        <tbody>
        @foreach($selected_data as $data)
        <tr>
            <td>
                Passport Picture
            </td>
            <td>Schoolmasoft</td>
            <td>Student Id Card</td>
        </tr>

        <tr>
            <td>Name: {{$data['userClass']['name']}}</td>
            <td>Class: {{$data['studentClass']['name']}}
            <td>ID: {{$data['userClass']['id_no']}}</td>
        </tr>
        <tr>
            <td>Roll: {{$data->roll}}</td>
            <td>Year: {{$data['studentYear']['name']}}
            <td>Mobile: {{$data['userClass']['mobile']}}</td>
        </tr>
           <tr>
               <td></td>
           </tr>
        @endforeach
        </tbody>

</table>

<br>
<hr style="border: 1px solid #368e10">
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
