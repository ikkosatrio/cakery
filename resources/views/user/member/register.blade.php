@extends('user/template')
@section('title')
{{$data['title']}}
@endsection()
@section('content')
<!--Page Title-->
<section class="page-title" style="background-image:url(https://images.unsplash.com/photo-1486427944299-d1955d23e34d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)">
    <div class="auto-container">
        <h1>{{$data['title']}}</h1>
    </div>
</section>
<!--End Page Title-->
<section class="login-section">
    <div class="auto-container">
        <!-- Login Form -->
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
        <div class="login-form">
            <h2>{{$data['title']}}</h2>
            <!--Login Form-->
            <form method="post" action="{{route('member.registerprocess')}}">
                @csrf
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text" name="name" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Email address *</label>
                    <input type="email" name="email" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Phone *</label>
                    <input type="text" name="phone" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Password Confirmation*</label>
                    <input type="password" name="password_confirmation" placeholder="" required>
                </div>

                <div class="form-group pass">
                    <a href="{{route('member.register')}}" class="psw"><input class="theme-btn" type="submit"
                            name="submit-form" value="Register Account"></a>
                </div>
            </form>
        </div>
        <!--End Login Form -->
    </div>
</section>

@endsection
