@extends('user/template')
@section('content')
<!--Page Title-->
<section class="page-title" style="background-image:url(https://images.unsplash.com/photo-1486427944299-d1955d23e34d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)">
    <div class="auto-container">
        <h1>{{$data['title']}}</h1>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <div class="shop-single">
                    <!-- Product Detail -->
                    <div class="product-details">
                        <!--Basic Details-->
                        <div class="basic-details">
                            <div class="row clearfix">
                                <div class="image-column col-md-6 col-sm-12">
                                    <figure class="image"><a href="{{$data['product']->ImagePath}}" class="lightbox-image" title="Image Caption Here"><img src="{{$data['product']->ImagePathMedium}}" alt=""><span class="icon fa fa-search"></span></a></figure>
                                </div>
                                <div class="info-column col-md-6 col-sm-12">
                                    <div class="details-header">
                                        <h4>{{$data['product']->title}}</h4>
                                        <div class="item-price">{{$data['product']->FinalPrice}}</div>
                                        <div class="text">{!!$data['product']->content!!}</div>
                                    </div>

                                    <div class="other-options clearfix">
                                        <div class="item-quantity">Quantity <input class="qty" type="number" value="1" name="quantity"></div>
                                        <button type="button" class="theme-btn add-to-cart" data-id="{{$data['product']->id}}"><span class="btn-title">Add To Cart</span></button>
                                        <ul class="product-meta">
                                            <li class="posted_in">Category: <a href="{{($data['product']->category) ?  route('shop',['category' => $data['product']->category->id]) : "#."}}">{{($data['product']->category) ?  $data['product']->category->title : "uncategorized"}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Basic Details-->
                        <!-- Related Products -->
                        <div class="related-products">
                            <div class="sec-title">
                                <h2>Related products</h2>
                            </div>

                            <div class="row clearfix">

                                @foreach ($data['related_product'] as $item)
                                    <!-- Shop Item -->
                                    <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <div class="image-box">

                                                @if ($item->isDiscount)
                                                <div class="sale-tag">sale!</div>
                                                @endif

                                                <figure class="image"><a href="{{$item->Link}}"><img src="{{$item->ImagePathSmall}}" alt="" style="max-height: 200px;object-fit: cover;"></a></figure>
                                                <div class="btn-box btnAdd" data-id="{{$item->id}}"><a href="{{$item->Link}}">Add to cart</a></div>
                                            </div>
                                            <div class="lower-content">
                                                <h4 class="name"><a href="{{$item->Link}}">{{$item->title}}</a></h4>
                                                <div class="price">
                                                    @if ($item->isDiscount)
                                                        <del>{{$item->price}}</del>
                                                    @endif
                                                    {{$item->FinalPrice}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End Related Products -->
                    </div><!-- Product Detail -->
                </div><!-- End Shop Single -->
            </div>

            <!--Sidebar Side-->
            <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
                <aside class="sidebar theiaStickySidebar">
                    <div class="sticky-sidebar">
                        <!-- Search Widget -->
                        <div class="sidebar-widget search-widget">
                            <form method="post" action="contact.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search products…" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>

                        @include('user/include/cart')

                        <!-- Tags Widget -->
                        @include('user/include/category')
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!--End Sidebar Page Container-->
<script>
    $(document).ready(function(){
       $(".add-to-cart").click(function (e) {
           e.preventDefault();
           var parent = $(this).closest('.product-details');
           var value = $(this).siblings('.item-quantity').find(".qty").val();
        //    console.log(value);
        //     debugger;
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 		'{{route('shop.addtocart')}}',
                method: 	'POST',
                data:  		{
                    id : $(this).attr('data-id'),
                    quantity:value ?? 0,
                },
                dataType : 'json',
                beforeSend: function(){
                    blockMessage(parent,'Please Wait','#fff');
                }
            })
            .done(function(data){
                $(parent).unblock();
                if(data.Code == 200){
                    showNotif("success","Success",data.Message);
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }else{
                    showNotif("error","Error",data.Message);
                }
            })
            .fail(function(e) {
                $(parent).unblock();
                showNotif("error","Error",e.responseText);
            })
       })


       $(".btnAdd").click(function(e){
            e.preventDefault();
            var parent = $(this).closest('.shop-item');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 		'{{route('shop.addtocart')}}',
                method: 	'POST',
                data:  		{
                    id : $(this).attr('data-id'),
                    quantity:1,
                },
                dataType : 'json',
                beforeSend: function(){
                    blockMessage(parent,'Please Wait','#fff');
                }
            })
            .done(function(data){
                $(parent).unblock();
                if(data.Code == 200){
                    showNotif("success","Success",data.Message);
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }else{
                    showNotif("error","Error",data.Message);
                }
            })
            .fail(function(e) {
                $(parent).unblock();
                showNotif("error","Error",e.responseText);
            })
       });
    })

</script>
@endsection
