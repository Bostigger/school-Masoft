@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Subject</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('setups/subject/update/'.$selected_subject->id)}}" id="AddFeeAmount" method="POST">
                    @csrf
                    <div class="add_item">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <h5>Enter Subject <span class="text-danger">*</span></h5>
                                    <div class="form-group">
                                        <input class="form-control"  value="{{$selected_subject -> subject_name}}" required type="text" id="fee_amount" name="subject_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Update Subject</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>

                @foreach($all_subjects  as $key=> $subject)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$subject->subject_name}}</td>
                        <td>{{$subject->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{url('setups/subject/edit/'.$subject->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                            <a href="{{url('setups/subject/delete/'.$subject->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
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


@endsection
