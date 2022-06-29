@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Fee Amount</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('setups/fee-category-amount/update/'.$selected_category[0]->fee_category_id)}}" id="AddFeeAmount" method="POST">
                    @csrf
                    <div class="add_item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Choose Fee Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="fee_category_id" id="select" required class="form-control">
                                            <option value="" selected disabled>Select Fee Category</option>
                                            @foreach($fee_categories as $fee_category )
                                                <option value="{{$fee_category->id}}" {{ ($selected_category[0]->fee_category_id==$fee_category->id)?"selected":"" }}>{{$fee_category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        @foreach($selected_category as $category)
                            <div class="remove_event_more" id="remove_event_more">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <h5>Enter Amount <span class="text-danger">*</span></h5>
                                    <div class="form-group">
                                        <input class="form-control" value="{{$category->fee_amount}}" required type="text" id="fee_amount" name="fee_amount[]">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <h5>Choose Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="student_class_id[]" id="select" required class="form-control">
                                            <option value="" selected disabled>Select Class</option>
                                            @foreach($student_classes as $class )
                                                <option value="{{$class->id}}" {{($category->student_class_id==$class->id)?"selected":""}}  ">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-4">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                            </div>
                        </div>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Edit Fee Amount</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="visibility: hidden">
        <div class="add_event_more" id="add_event_more">
            <div class="remove_event_more" id="remove_event_more">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Enter Amount <span class="text-danger">*</span></h5>
                            <div class="form-group">
                                <input class="form-control"  required type="text" id="fee_amount" name="fee_amount[]">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Choose Class <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="student_class_id[]" id="select" required class="form-control">
                                    <option value="" selected disabled>Select Class</option>
                                    @foreach($student_classes as $class )
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
