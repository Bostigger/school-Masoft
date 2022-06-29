@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>

    <br>
    <div class="box-body">
       <div class="box-body">
           <h3>Generate Slip</h3>
       </div>
        <form action="{{url('employees/monthly/salary-slip/'.$selected_employee->employee_id)}}" method="post">
            @csrf
            <div class="row box-body">
               <div class="col-md-6">
                   <input type="date" name="date" required class="form-control">
               </div>
                <div class="col-md-6">
                    <input type="submit" class="btn btn-warning" value="Proceed">
                </div>
            </div>
            <br>
            <div class="row">
                <!--Bordery boxs!-->
                <div  class="box-body">
                    <div class="col-md-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Employee <strong>Monthly Fee</strong></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Monthly Salary</th>
                                            <th>Number of Absents</th>
                                            <th>Amount Payable</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>{{$selected_employee['userClass']['name']}}</td>
                                            <td>{{$selected_employee['userClass']['id_no']}}</td>
                                            <td>{{$selected_employee['userClass']['salary']}}</td>
                                            <td>{{$count_absent}}</td>
                                            <td>{{
                                                  $selected_employee['userClass']['salary']- ($selected_employee['userClass']['salary'])/30 * $count_absent

                                                 }}
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

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
