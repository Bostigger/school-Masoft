@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Assign New Class</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('setups/assign-subject/update/'.$assignment_to_edit[0]->student_class_id)}}" id="AddNewAssignment" method="POST">
                    @csrf
                    <div class="add_item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Choose Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="student_class_id" id="select" required class="form-control">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($all_classes as $class )
                                                <option value="{{$class->id}}" {{($assignment_to_edit[0]->student_class_id==$class->id)?"selected":""}}>{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>


                        </div>

                       @foreach($assignment_to_edit as $assignment)
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Assign Subject <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subject_id[]" id="select" required class="form-control">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($all_subjects as $subject)
                                                <option value="{{$subject->id}}" {{($assignment->subject_id==$subject->id)?"selected":""}}>{{$subject->subject_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Enter Pass Mark <span class="text-danger">*</span></h5>
                                    <div class="form-group">
                                        <input class="form-control" value="{{$assignment -> pass_mark}}"  required type="text" id="pass_mark" name="pass_mark[]">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Subjective Mark<span class="text-danger">*</span></h5>
                                    <div class="form-group">
                                        <input class="form-control" value="{{$assignment -> subjective_mark}}"  required type="text" id="subjective_mark" name="subjective_mark[]">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Full Marks <span class="text-danger">*</span></h5>
                                    <div class="form-group">
                                        <input class="form-control" value="{{$assignment -> full_marks}}" required type="text" id="full_mark" name="full_marks[]">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>

                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Update Assign Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="visibility: hidden">
        <div class="add_event_more" id="add_event_more">
            <div class="remove_event_more" id="remove_event_more">


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Assign Subject <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subject_id[]" id="select" required class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($all_subjects as $subject)
                                        <option value="{{$subject->id}}" {{($assignment_to_edit[0]->subject_id==$subject->id)?"selected":""}}>{{$subject->subject_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Enter Pass Mark <span class="text-danger">*</span></h5>
                            <div class="form-group">
                                <input class="form-control"  required type="text" id="pass_mark" name="pass_mark[]">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Subjective Mark<span class="text-danger">*</span></h5>
                            <div class="form-group">
                                <input class="form-control"  required type="text" id="subjective_mark" name="subjective_mark[]">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Full Marks <span class="text-danger">*</span></h5>
                            <div class="form-group">
                                <input class="form-control"  required type="text" id="full_mark" name="full_marks[]">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-4">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
                $('#AddNewAssignment').validate({
                    rules:{
                        fee_amount : {
                            required:true,
                        },
                        student_class_id : {
                            required:true,
                        },
                        fee_category_id : {
                            required:true,
                        },

                    },
                    messages:{
                        fee_amount:{
                            required:'Please provide amount'
                        },
                        student_class_id:{
                            required:'Please Choose Class'
                        },
                        fee_category_id :{
                            required:'Please Choose Category'
                        },

                    },
                    errorElement : 'span',
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function (element,errorClass,validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function (element,errorClass,validClass) {
                        $(element).removeClass('is-invalid');
                    },
                })

            }
        )
    </script>
    <script>
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click",".addeventmore",function () {
                var add_event_more = $("#add_event_more").html();
                $(this).closest(".add_item").append(add_event_more);
                counter++;
            });
            $(document).on("click",".removeeventmore",function (event) {
                $(this).closest(".remove_event_more").remove();
                counter-=1;
            });
        });
    </script>

@endsection
