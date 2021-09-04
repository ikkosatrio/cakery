@extends('user/template')

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
        <!-- Login Form -->
        <div class="login-form">
            <h2>Login</h2>
            <!--Login Form-->
            <form method="post" action="{{route('member.loginprocess')}}">
                @csrf
                <div class="form-group">
                    <label>Email address *</label>
                    <input type="text" name="email" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" placeholder="" required>
                </div>

                <div class="form-group">
                    <input class="theme-btn" type="submit" name="submit-form" value="Log in">
                    <a href="#" class="psw">Lost your password?</a>
                </div>

                <div class="form-group">
                    {{-- <input type="checkbox" name="shipping-option" id="account-option-1">&nbsp; <label for="account-option-1">Remember me</label> --}}
                </div>

                <div class="form-group pass">

                </div>
                <div class="form-group pass">
                    <a href="{{route('member.register')}}" class="psw"><input class="theme-btn" type="button" name="submit-form" value="Register Account"></a>
                </div>
            </form>
        </div>
        <!--End Login Form -->
    </div>
</section>

@endsection
