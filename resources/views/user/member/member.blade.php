@extends('user/template')

@section('content')

<!--Page Title-->
<section class="page-title"
    style="background-image:url(https://images.unsplash.com/photo-1486427944299-d1955d23e34d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)">
    <div class="auto-container">
        <h1>{{$data['title']}}</h1>
    </div>
</section>
<!--End Page Title-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Sidebar Side-->
            <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
                <aside class="sidebar theiaStickySidebar">
                    <div class="sticky-sidebar">
                        <!-- Category  Widget -->
                        <div class="sidebar-widget category-widget">
                            <div class="widget-content">
                                <h3 class="widget-title">Menu</h3>
                                <ul class="categories-list2">
                                    <li class="{{Route::is('member') ? 'active' : ''}}"><a href="#">Profile</a></li>
                                    <li><a href="#">History Order Cake</a></li>
                                    <li><a href="#">History Order Non Cake</a></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <!--Content Side-->
            <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <div class="blog-sidebar">
                    <!-- News Block -->
                    <div class="">
                        <div class="inner-box">
                            <div class="content-column">
                                <div class="inner-column">
                                    <h3>Profile</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-block">
                                                <button type="button" class="close" data- dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="login-form">
                                                <form method="post" action="{{route('member.profileprocess')}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="name" placeholder=""
                                                            value="{{Auth::guard('member')->user()->name}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email address</label>
                                                        <input type="email" name="email"
                                                            value="{{Auth::guard('member')->user()->email}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" placeholder=""
                                                            value="{{Auth::guard('member')->user()->phone}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old_password" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password" placeholder="">
                                                    </div>

                                                    <div class="form-group pass">
                                                        <a href="{{route('member.register')}}" class="psw"><input
                                                                class="theme-btn" type="submit" name="submit-form"
                                                                value="Save"></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection
