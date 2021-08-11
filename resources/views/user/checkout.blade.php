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

<!--CheckOut Page-->
<section class="checkout-page">
    <div class="auto-container">
        <!--Default Links-->
        {{-- <div class="default-links">
            <div class="message-box with-icon info"><div class="icon-box"><span class="icon fa fa-info"></span></div> Have a coupon? <a href="#">Click here to enter your code</a></div>
        </div> --}}

        <!--Checkout Details-->
        <div class="checkout-form">
            <form method="post" id="formInput" action="{{route('shop.processcheckout')}}">
                <div class="row clearfix">
                    <!--Column-->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="sec-title">
                                <h3>Billing details</h3>
                            </div>

                            <!--Form Group-->
                            <div class="form-group">
                                <div class="field-label">Name <sup>*</sup></div>
                                <input type="text" name="name" value="" id="inputName" placeholder="">
                            </div>

                            <!--Form Group-->
                            <div class="form-group">
                                <div class="field-label">Address <sup>*</sup></div>
                                <input type="text" name="address" value="" id="inputAddress" placeholder="House number and street name">
                            </div>

                            <div class="form-group">
                                <div class="field-label">Province <sup>*</sup></div>
                                <select name="province" id="selectProvince" class="form-control select2">
                                    <option value="0">Choose</option>
                                    @foreach ($data['province'] as $item)
                                        <option data-id="{{$item->province_id}}" value="{{$item->province}}">{{$item->province}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!--Form Group-->
                            <div class="form-group">
                                <div class="field-label">City <sup>*</sup></div>
                                <select name="city" id="selectCity" class="form-control select2">
                                    <option value="0">Choose</option>
                                </select>
                            </div>

                            <!--Form Group-->
                            <div class="form-group">
                                <div class="field-label">Postcode/ ZIP <sup>*</sup></div>
                                <input type="text" name="postcode" value="" id="inputZipcode" placeholder="" required="">
                            </div>

                            <!--Form Group-->
                            <div class="form-group">
                                <div class="field-label">Phone</div>
                                <input type="text" name="phone" value="" id="inputPhone" placeholder="" required>
                            </div>

                            <!--Form Group-->
                            <div class="form-group">
                                <div class="field-label">Email Address</div>
                                <input type="email" name="email" value="" id="inputEmail" placeholder="" required>
                            </div>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="sec-title">
                                <h3>Additional information</h3>
                            </div>

                            <!--Form Group-->
                            <div class="form-group ">
                                <div class="field-label">Order notes (optional)</div>
                                <textarea name="note" class="" placeholder="Notes about your order,e.g. special notes for delivery." ></textarea>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <!--End Checkout Details-->

        <!--Order Box-->
        <div class="order-box">
            <table>
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th>Price</th>
                        <th class="product-total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['cart'] as $item)
                        <tr class="cart-item">
                            <td class="product-name">{{$item->name}}&nbsp;
                                <strong class="product-quantity">× {{$item->quantity}}</strong>
                            </td>
                            <td>
                                {{number_format($item->price)}}
                            </td>
                            <td class="product-total">
                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{number_format($item->quantity*$item->price)}}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="cart-subtotal">
                        <th colspan="2">Subtotal</th>
                        <td><span class="amount">{{number_format(\Cart::getSubTotal())}}</span></td>
                    </tr>
                    <tr class="order-total">
                        <th colspan="2">Total</th>
                        <td><strong class="amount" id="txtTotal" data-total='{{\Cart::getTotal()}}'>{{number_format(\Cart::getTotal())}}</strong> </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--End Order Box-->

        <!--Payment Box-->
        <div class="payment-box">
            <div class="upper-box">
                <!--Payment Options-->
                <div class="payment-options">
                    <ul>
                        <li>
                            <div class="radio-option">
                                <input type="radio" name="payment_method" id="payment-2" checked value="bank_transfer">
                                <label for="payment-2"><strong>Bank Transfer</strong>
                                    <span class="small-text">
                                        {{$profile->note_banktransfer}}
                                        <br>
                                        <div class="lower-box">
                                            <button type="submit" class="theme-btn"><span class="btn-title">Place Order</span></button>
                                        </div>
                                    </span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="radio-option">
                                <input type="radio" name="payment_method" id="payment-1" value="paypal">
                                <label for="payment-1"><strong>Paypal</strong>
                                    <span class="small-text">
                                        {{$profile->note_paypal}}
                                        <br>
                                        <div id="paypal-button-container"></div>
                                    </span>
                                </label>
                            </div>
                        </li>

                        <li>
                            <div class="radio-option">
                                <input type="radio" name="payment_method" id="payment-3" value="cod">
                                <label for="payment-3"><strong>Cash on Delivery</strong>
                                    <span class="small-text">
                                        {{$profile->note_cod}}
                                        <br>
                                        <div class="lower-box">
                                            <button type="submit" class="theme-btn"><span class="btn-title">Place Order</span></button>
                                        </div>
                                    </span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    {{-- <div class="text">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></div> --}}
                </div>
            </div>

        </div>
    </form>
        <!--End Payment Box-->
    </div>
</section>
<script src="https://www.paypal.com/sdk/js?client-id=AXEzWU-vZEjbUI1tBHmBfvTsOdFWXQhAfWOdIhkDRq37lCwxmbDdnWTuKFJkc6f_VIdKO2WZVMowzLC1&enable-funding=venmo&currency=AUD" data-sdk-integration-source="button-factory"></script>
<script>
  var finalCheck = false;
  function sendOrderConfirm(orderData) {
    var formData = new FormData($("#formInput")[0]);
    formData.append("Payment", JSON.stringify(orderData));


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '{{route('shop.paymentpaypal')}}',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
                blockMessage($('#formInput'),'Please Wait','#fff');
            }
    }).done(function(data){
        $('#formInput').unblock();
        if(data.Code == 200){
            Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: 'Thank you for your payment!',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Check Your Email!', '', 'success')
                    setTimeout(function(){
                        redirect('{{route('shop')}}');
                    }, 2000);
                }
            })
        }else{
            showNotif("error","Error",data.Message);
        }
    })
    .fail(function(e) {
        $('#formInput').unblock();
        showNotif("error","Error",e.responseText);
    })
  }

  var paypalActions;
  function initPayPalButton() {
    var valueTotal = $("#txtTotal").attr("data-total");
    console.log("asd",valueTotal)
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',

      },

    onInit: function(data, actions) {
        // Disable the buttons
        actions.disable();
        // Listen for changes
        $("#inputEmail,#inputName,#inputPhone").change(function() {
            var valid=true;
            $("#inputEmail").each(function(){
                if($(this).val()=="") valid=false;
            });

            $("#inputName").each(function(){
                if($(this).val()=="") valid=false;
            });

            $("#inputPhone").each(function(){
                if($(this).val()=="") valid=false;
            });

            if (valid==true) {
                actions.enable();
            } else {
                // showNotif("info","Info","Please check your form completation");
                actions.disable();
            }

        });
    },

      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [
              {"amount":
                {
                    "currency_code":"AUD",
                    "value":valueTotal
                }
              }
            ]
        });
      },

      onClick: function(data, actions) {
        if(finalCheck == false){
            showNotif('info','Info',"Please check your form completation")
        }
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {

          // Full available details

          sendOrderConfirm(orderData);
          console.log('Capture result 2',orderData);
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');

        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>


<script>
    $(document).ready(function(){
        $("#formInput").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $("#formInput").attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType : 'json',
                encode : true,
                beforeSend: function(){
                    blockMessage($('#formInput'),'Please Wait','#fff');
                }
            })
            .done(function(data){
                $('#formInput').unblock();
                if(data.Code == 200){
                    showNotif("success","Success",data.Message);
                }else{
                    showNotif("error","Error",data.Message);
                }
            })
            .fail(function(e) {
                $('#formInput').unblock();
                showNotif("error","Error",e.responseText);
            })
        })


       $("#selectProvince").change(function (e) {
           e.preventDefault();
           var parent = $(this).closest("form");
           var value = $('option:selected', this).attr('data-id');

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 		'{{route('shop.getcity')}}',
                method: 	'POST',
                data:  		{
                    province_id : value,
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
                    var html = "";
                    $.each(data.Data, function( index, value ) {
                        html += "<option data-id='"+value.city_id+"' value='"+value.city_name+"'>"+value.city_name+"</option>";
                    });
                    console.log(html);
                    $("#selectCity").html(html);
                    $(".select2");
                }else{
                    showNotif("error","Error",data.Message);
                }
            })
            .fail(function(e) {
                $(parent).unblock();
                showNotif("error","Error",e.responseText);
            })
       })
    })

</script>
@endsection
