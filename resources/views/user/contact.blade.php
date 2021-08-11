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

<!-- Contact Section -->
<section class="contact-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <div class="divider"><img src="images/icons/divider_1.png" alt=""></div>
            <h2>Our Contacts</h2>
            <div class="text">{{$config->description}}</div>
        </div>

        <div class="row clearfix">
            <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                {{-- <div class="inner-column">
                    <div class="title">
                        <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                        <h4>Opening Hours</h4>
                    </div>

                    <ul class="contact-info">
                        <li>asdasd asda sd as dasdasd as das das das d asdasd as d asdasdas saasdasdas asdasdasdasd asdasdasdas </li>
                    </ul>
                </div> --}}
            </div>

            <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12 order-3">
                <div class="inner-column">
                    <div class="title">
                        <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                        <h4>Our Contacts</h4>
                    </div>

                    <ul class="contact-info">
                        <li>{{$profile->address}}</li>
                        <li><a href="tel:{{$profile->phone}}">{{$profile->phone}}</a></li>
                        <li><a href="mailto:{{$profile->email}}">{{$profile->email}}</a></li>
                    </ul>
                </div>
            </div>

            <!-- Form Column -->
            <div class="column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="title">
                        <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                        <h4>Send Message</h4>
                    </div>
                    <div class="contact-form">
                        <form action="#" method="post" id="email-form">

                            <div class="form-group">
                                <div class="response"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="username" class="username" placeholder="Your Name *">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="email" placeholder="Your Email *">
                            </div>

                            <div class="form-group">
                                <textarea name="contact_message" placeholder="Text Message"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="theme-btn" type="button" id="submit" name="submit-form">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Contact Section -->

<!-- Map Section -->
<section class="map-section">
    {{$config->map_script}}
</section>
<!-- End Map Section -->

@endsection
