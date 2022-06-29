@extends('admin.admin-master')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
    <div class="row">
        <!--Bordery boxs!-->
        <div  class="box-body">
            <div class="col-md-12">
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Generate Students <strong>Results</strong></h4>
                    </div>
                    <div class="box-body">
                        <form action="{{route('student.results.details.get')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Year</label>
                                    <div class="controls">
                                        <select name="year_id" id="year_id" required class="form-control">
                                            <option value="" selected disabled>Select Year</option>
                                            @foreach($student_years as $year)
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @error('year_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>Class</label>
                                    <div class="controls">
                                        <select name="class_id" id="class_id" required class="form-control">
                                            <option value="" selected disabled>Select Class</option>
                                            @foreach($student_classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @error('class_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>Exam Type</label>
                                    <div class="controls">
                                        <select name="exam_type" id="exam_type" required class="form-control">
                                            <option value="" selected disabled>Select Exam Type</option>
                                            @foreach($exam_types as $exam)
                                                <option value="{{$exam->id}}">{{$exam->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @error('exam_type')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary mt-4" value="Proceed">
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
