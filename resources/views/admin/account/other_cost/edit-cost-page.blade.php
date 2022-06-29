@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Update Cost</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('accounts/other-cost/update/'.$selected_cost->id)}}" id="AddExamType" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{$selected_cost->image}}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_cost->date}}" required type="date" id="date" name="date">
                                </div>
                            </div>
                            @error('date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Amount</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_cost->amount}}" required type="text" id="amount" name="amount">
                                </div>
                            </div>
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="form-control">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset($selected_cost->image)}}" alt="" id="new_image" style='height:90px; width:90px'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="5" cols="5" name="description" class="form-control" >{{$selected_cost->description}}</textarea>
                            </div>
                        </div>
                    </div>



                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Update other Cost</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
                $('#AddExamType').validate({
                    rules:{
                        name : {
                            required:true,
                        },

                    },
                    messages:{
                        name:{
                            required:'Please provide name'
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#new_image').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection
