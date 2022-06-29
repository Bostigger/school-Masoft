@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New Subject</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('add.subject')}}" id="AddFeeAmount" method="POST">
                    @csrf
                    <div class="add_item">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <h5>Enter Subject <span class="text-danger">*</span></h5>
                                    <div class="form-group">
                                        <input class="form-control"  required type="text" id="fee_amount" name="subject_name[]">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-4">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Add Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="visibility: hidden">
        <div class="add_event_more" id="add_event_more">
            <div class="remove_event_more" id="remove_event_more">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <h5>Enter Subject <span class="text-danger">*</span></h5>
                            <div class="form-group">
                                <input class="form-control"  required type="text" id="fee_amount" name="subject_name[]">
                            </div>
                            @error('subject_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 mt-4">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
                $('#AddFeeAmount').validate({
                    rules:{
                        subject_name : {
                            required:true,
                        },

                    },
                    messages:{
                        subject_name:{
                            required:'Please provide Subject Name'
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
