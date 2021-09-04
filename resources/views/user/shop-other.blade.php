@extends('user/template')
@section('title')
{!!$data['title']!!}
@endsection
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
                <div class="our-shop">
                    <div class="shop-upper-box clearfix">
                        <div class="items-label">Showing all {{ $data['product']->total() }}  results</div>
                        <div class="orderby">
                            <select name="orderby" class="sortby-select select2-offscreen">
                                <option value="1">Newest</option>
                                <option value="2" >Older</option>
                                <option value="3" >A - Z</option>
                                <option value="4" >Z - A</option>
                                <option value="5" >Highest</option>
                                <option value="6" >Lowest</option>
                            </select>
                        </div>
                    </div>

                    <div class="row clearfix">

                        @foreach ($data['product'] as $item)
                            <!-- Shop Item -->
                            <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="image-box">
                                        @if ($item->isDiscount)
                                        <div class="sale-tag">sale!</div>
                                        @endif
                                        <figure class="image"><a href="{{$item->Link}}"><img src="{{$item->ImagePath}}" alt="" style="max-height: 200px;object-fit: cover;"></a></figure>
                                        <div class="btn-box btnAdd" data-id="{{$item->id}}"><a href="{{$item->Link}}">Add to cart</a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h4 class="name"><a href="{{$item->Link}}">{{$item->title}}</a></h4>
                                        <div class="price">
                                            @if ($item->isDiscount)
                                                <del>{{$item->PriceNice}}</del>
                                            @endif
                                            {{$item->FinalPriceNice}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="styled-pagination text-center">
                            {{ $data['product']->links("user/include/pagination") }}

                    </div>
                </div>
            </div>

            <!--Sidebar Side-->
            <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
                <aside class="sidebar theiaStickySidebar">
                    <div class="sticky-sidebar">
                        <!-- Search Widget -->
                        <div class="sidebar-widget search-widget">
                            <form method="get" action="">
                                <div class="form-group">
                                    <input type="search" name="keyword" value="{{isset($data['currentParam']['keyword']) ? $data['currentParam']['keyword'] : ""}}" placeholder="Search products…">
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>

                        @include('user/include/cart-other')

                        <!-- Tags Widget -->
                        @include('user/include/category-other')
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!--End Sidebar Page Container-->
<script>
    $(document).ready(function(){
       $(".btnAdd").click(function(e){
            e.preventDefault();
            var parent = $(this).closest('.shop-item');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 		'{{route('other.shop.addtocart')}}',
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

