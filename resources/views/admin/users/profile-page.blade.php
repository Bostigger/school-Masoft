@extends('admin.admin-master')
@section('admin')

    <div class="col-lg-12">
        <br><div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url({{ asset('images/original.jpg') }}) center center;">
                <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
                <h6 class="widget-user-desc">Developer</h6>
            </div>
            <div class="widget-user-image">
                <img class="rounded-circle" src="{{ asset(Auth::user()->photo_url) }}" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">12K</h5>
                            <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 br-1 bl-1">
                        <div class="description-block">
                            <h5 class="description-header">550</h5>
                            <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">158</h5>
                            <span class="description-text">TWEETS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <br><div class="box">
            <div class="box-body box-profile">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-6">
                            <div>
                                <p>Email :<span class="text-gray pl-10">{{Auth::user()->email}}</span> </p>
                                <p>Phone :<span class="text-gray pl-10">+11 123 456 7890</span></p>
                                <p>Address :<span class="text-gray pl-10">123, Lorem Ipsum, Florida, USA</span></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="pb-15">
                                <p class="mb-10">Social Profile</p>
                                <div class="user-social-acount">
                                    <button class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></button>
                                    <button class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></button>
                                    <button class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></button>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('users/user/edit/'.Auth::user()->id)}}" class="btn btn-info">Edit Profile</a>

                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection
