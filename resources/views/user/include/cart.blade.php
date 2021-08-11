<!-- Cart Widget -->
<div class="sidebar-widget cart-widget">
    <div class="widget-content">
        <h3 class="widget-title">Cart</h3>

        <div class="shopping-cart">
            <ul class="shopping-cart-items">
                @foreach ($data['cart'] as $item)
                <li class="cart-item">
                    <img src="{{$item->associatedModel->ImagePathSmall}}" alt="#" class="thumb" />
                    <span class="item-name">{{$item->name}}</span>
                    <span class="item-quantity">{{$item->quantity}} x <span class="item-amount">{{number_format($item->price)}}</span></span>
                    <span class="item-quantity"><span class="item-amount">{{number_format($item->price*$item->quantity)}}</span></span>
                    <a href="{{$item->associatedModel->Link}}" class="product-detail"></a>
                    <button class="remove-item"><span class="fa fa-times"></span></button>
                </li>
                @endforeach
            </ul>

            <div class="cart-footer">
                <div class="shopping-cart-total"><strong>Subtotal:</strong> {{number_format(\Cart::getTotal())}}</div>
                {{-- <a href="cart.html" class="theme-btn">View Cart</a> --}}
                <a href="{{route('shop.checkout')}}" class="theme-btn pull-right">Checkout</a>
            </div>
        </div> <!--end shopping-cart -->
    </div>
</div>
