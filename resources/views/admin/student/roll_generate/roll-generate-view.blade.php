@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="row">
        <!--Bordery boxs!-->
        <div  class="box-body">
            <div class="col-md-12">
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Search <strong>Student</strong></h4>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{url('students/roll/generate-roll/')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Student Year</label>
                                        <div class="controls">
                                            <select name="year_id" id="year_id" required class="form-control">
                                                <option value="" selected disabled>Select Year</option>
                                                @foreach($student_years as $year)
                                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('year_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Student Class</label>
                                        <div class="controls">
                                            <select name="class_id" id="class_id" required class="form-control">
                                                <option value="" selected disabled>Select Class</option>
                                                @foreach($student_class as $class)
                                                    <option value="{{$class->id}}" >{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <a class="btn btn-primary mt-4" id="search">Search</a>
                                </div>
                            </div>

                            <div class="row d-none" id="roll-generate">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                       <tr>
                                           <th>ID No</th>
                                           <th>Student Name</th>
                                           <th>Father's Name</th>
                                           <th>Gender</th>
                                           <th>Roll No</th>
                                       </tr>
                                        </thead>
                                        <tbody id="roll-generate-tr">

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info" value="Generate Roll">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on('click','#search',function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            $.ajax({
                url:"{{route('get.all.students')}}",
                type:"GET",
                data:{'year_id':year_id,'class_id':class_id},
                success:function (data) {
                    $('#roll-generate').removeClass('d-none');
                    let html ='';
                    $.each( data, function (key,v) {
                        html +=
                            '<tr>' +
                            '<td>'+v.user_class.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                            '<td>'+v.user_class.name+'</td>'+
                            '<td>'+v.user_class.fname+'</td>'+
                            '<td>'+v.user_class.gender+'</td>'+
                            '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
                            '</tr>';
                    });
                    html = $('#roll-generate-tr').html(html);
                }
            });
        });
    </script>

@endsection
