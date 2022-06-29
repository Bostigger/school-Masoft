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
                        <form method="POST" action="{{route('edit.student.marks')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Student Class</label>
                                        <div class="controls">
                                            <select name="class_id" id="class_id" required class="form-control">
                                                <option value="" selected disabled>Select Class</option>
                                                @foreach($student_classes as $class)
                                                    <option value="{{$class->id}}" >{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <div class="controls">
                                            <select name="assign_subject_id" id="assign_subject_id" required class="form-control">
                                                <option value="">Select Subject</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Exam Type</label>
                                        <div class="controls">
                                            <select name="exam_type_id" id="exam_type_id" required class="form-control">
                                                <option value="" selected disabled>Select Exam Type</option>
                                                @foreach($exam_types as $exam)
                                                    <option value="{{$exam->id}}" >{{$exam->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <a class="btn btn-primary mt-4" id="fetch">Fetch</a>
                                </div>
                            </div>

                            <div class="row d-none" id="student-marks">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID No</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th>Gender</th>
                                            <th>Marks</th>
                                        </tr>
                                        </thead>
                                        <tbody id="marks-insert-tr">

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="d-none" id="insert-marks">
                                <input type="submit" class="btn btn-secondary" value="Update Marks">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on('click','#fetch',function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();
            $.ajax({
                url:"{{route('get.previous.marks')}}",
                type:"GET",
                data:{'year_id':year_id,'class_id':class_id,'assign_subject_id':subject_id,'exam_type_id':exam_type_id},
                success:function (data) {
                    $('#student-marks').removeClass('d-none');
                    $('#insert-marks').removeClass('d-none');
                    let html ='';
                    $.each( data, function (key,v) {
                        html +=
                            '<tr>' +
                            '<td>'+v.user_class.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+v.user_class.id_no+'">' +
                            '</td>'+
                            '<td>'+v.user_class.name+'</td>'+
                            '<td>'+v.user_class.fname+'</td>'+
                            '<td>'+v.user_class.gender+'</td>'+
                            '<td><input type="text" class="form-control form-control-sm" name="marks[]" value="'+v.marks+'"></td>'+
                            '</tr>';
                    });
                    html = $('#marks-insert-tr').html(html);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $(document).on('change','#class_id',function () {
                var class_id = $('#class_id').val();
                $.ajax({
                    url:"{{route('marks.get.subject')}}",
                    type:'GET',
                    data:{class_id:class_id},
                    success:function (data) {
                        var html = '<option value="">Select Subject</option>';
                        $.each(data,function (key,v) {
                            html += '<option value="'+v.id+'">'+v.subject_class.subject_name+'</option>';
                        });
                        $('#assign_subject_id').html(html);
                    }
                });
            });
        });
    </script>

@endsection
