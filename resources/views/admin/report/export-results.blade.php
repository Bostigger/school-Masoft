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

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

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

<h2>Results For <strong>{{$selected_data[0]['ExamTypeClass']['name']}}</strong></h2>

<table id="customers">

    <tr>
        <td><h3>SchoolMasoft </h3></td>
        <td><h3>Contact Details</h3>
            <p>Email: support@schoolmasoft.com</p>
            <p>Tel: 233559099224</p>
            <p>Address: Paa Grant Street, UX 45493</p>
        </td>
    </tr>

</table>

<br>

<table>
    <thead>
    <tr>
        <td>Year {{$selected_data[0]['YearClass']['name']}} </td>
        <td>Class {{$selected_data[0]['StudentClass']['name']}}</td>
    </tr>
    </thead>
</table>
<table id="customers">
    <thead>

    <tr>
        <th>SL</th>
        <th>Student Name</th>
        <th>Student ID</th>
        @foreach($selected_data as $data)
            @php
                $single_subject = \App\Models\StudentMarks::where('student_id',$data->student_id)->get();
                #dd($single_subject)->toArray();
            @endphp
            @foreach($single_subject as $subject)
                <th>{{$subject['AssignSubjectClass']['SubjectClass']['subject_name']}}</th>
            @endforeach
            @break
        @endforeach
        <th>Marks</th>

    </tr>
    </thead>
    <tbody>
    @foreach($selected_data as $key=> $data)
        @php
            $single_std = \App\Models\StudentMarks::where('student_id',$data->student_id)->get();
            #dd($single_std)->toArray();
             $totalmarks = 0.0;
        @endphp

        <tr>
            <td>{{$key+1}}</td>
            <td>{{$single_std[0]['userClass']['name']}}</td>
            <td>{{$single_std[0]['userClass']['id_no']}}</td>
            @foreach($single_std as $std)
                @php
                    $totalmarks = $totalmarks + $std->marks;
                @endphp
                <td>{{$std->marks}}</td>
            @endforeach
            <td>{{$totalmarks}}</td>
        </tr>

    @endforeach
    </tbody>
</table>

<br>
<h4>Rankings</h4>
<table id="customers">
    <thead>
    <tr>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>Total Marks</th>
        <th>Position</th>
    </tr>
    </thead>

    @foreach($selected_data as $data)
        @php
           $count_marks = \App\Models\StudentMarks::where('student_id',$data->student_id)->sum('marks');
           $single_std = \App\Models\StudentMarks::where('student_id',$data->student_id)->get();
           $ranking[] = [
               'name'=>$single_std[0]['userClass']['name'],
               'id_no'=>$single_std[0]['userClass']['id_no'],
               'marks'=>$count_marks];

           $marks = array_column($ranking, 'marks');
           array_multisort($marks,SORT_DESC,$ranking);

        @endphp
    @endforeach
    <tbody>

        @foreach($ranking as $key=> $rank)
            <tr>
            <td>{{$rank['name']}}</td>
            <td>{{$rank['id_no']}}</td>
            <td>{{$rank['marks']}}</td>
            <td>{{$key+1}}</td>
            </tr>
        @endforeach

    </tbody>
</table>
<i style="font-size: 10px; float:right">Print Data {{date('d M Y')}}</i>
</body>
</html>
