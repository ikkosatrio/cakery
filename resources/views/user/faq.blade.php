@extends('user/template')
@section('title')
{!!$data['title']!!}
@endsection
@section('content')

<!--Page Title-->
<section class="page-title" style="background-image:url(https://images.unsplash.com/photo-1486427944299-d1955d23e34d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)">
    <div class="auto-container">
        <h1>{!!$data['title']!!}</h1>
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
                    <div class="panel-group" id="faqAccordion">

                        @foreach ($data['data'] as $item)

                        <div class="panel panel-default ">
                            <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question{{$item->id}}">
                                 <h4 class="panel-title">
                                    <a href="#" class="ing">Q: {{$item->question}}</a>
                              </h4>
                            </div>
                            <div id="question{{$item->id}}" class="panel-collapse collapse" style="height: 0px;">
                                <hr>
                                <div class="panel-body">
                                     <h5><span class="label label-primary">Answer</span></h5>

                                    <p>{!! $item->answer !!}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
