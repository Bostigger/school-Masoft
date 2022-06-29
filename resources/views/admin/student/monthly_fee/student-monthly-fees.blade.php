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
                        <h4 class="box-title">Student <strong>Monthly Fee</strong></h4>
                    </div>
                    <div class="box-body">
                        <form action="{{route('monthly.fee.select')}}" method="post">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <div class="controls">
                                            <select name="month" id="month" required class="form-control">
                                                <option value="" selected disabled>Select Class</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary mt-4" value="Proceed">
                                </div>
                            </div>
                        </form>

                        {{--                            <div class="row">--}}
                        {{--                                <div class="col-md-12">--}}
                        {{--                                    <h2>2</h2>--}}
                        {{--                                <div id="DocumentResults">--}}
                        {{--                                    <script id="document-template" type="text/x-handlebars-template">--}}
                        {{--                                    <table class="table table-bordered table-striped">--}}
                        {{--                                        <thead>--}}
                        {{--                                        <tr>--}}
                        {{--                                            @{{thsource}}--}}
                        {{--                                        </tr>--}}
                        {{--                                        </thead>--}}
                        {{--                                        <tbody>--}}
                        {{--                                           @{{ #each this }}--}}
                        {{--                                            <tr>--}}
                        {{--                                                @{{tdsource}}--}}
                        {{--                                            </tr>--}}
                        {{--                                           @{{ /each }}--}}

                        {{--                                        </tbody>--}}
                        {{--                                    </table>--}}

                        {{--                                    </script>--}}
                        {{--                                </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

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
                url: "{{route('student.registration.fee.get')}}",
                type: "GET",
                data: {'year_id':year_id,'class_id':class_id},
                beforeSend:function(){
                },
                success: function (data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>


@endsection
