@extends('user/template')
@section('title')
{!!$data['title']!!}
@endsection
@section('content')

<!--Page Title-->
<section class="page-title" style="background-image:url(https://images.unsplash.com/photo-1486427944299-d1955d23e34d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)">
    <div class="auto-container">
        <h1>{{$data['data']->title}}</h1>
    </div>
</section>
<!--End Page Title-->

    <!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Content Side-->
            <div class="content-side col-lg-12 col-md-12 col-sm-12">
                <div class="blog-single">
                    <!-- News Block -->
                    <div class="news-block">
                        <div class="inner-box">
                            <div class="content-column">
                                <div class="inner-column">
                                    {!! $data['data']->content !!}
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
