@extends('admin/template-print')
@section('title')
{{$data['title']}}
@endsection
@section('css')
<style>
    .heading-elements button {
        margin-right: 10px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper" id="print-area">
    <!-- /page header -->
    <!-- Content area -->
    <div class="content">

        <!-- Invoice template -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Invoice</h6>

            </div>

            <div class="card-body no-padding-bottom">
                <div class="row">
                    <div class="col-sm-6 content-group">
                        <img src="{{$config->LogoPath}}" class="content-group mt-10" alt="" style="width: 120px;">
                         <ul class="list-condensed list-unstyled">
                            <li>{{$profile->name}}</li>
                            <li>{{$profile->address}}</li>
                            <li>{{$profile->phone}}</li>
                        </ul>
                    </div>

                    <div class="col-sm-6 content-group" style="text-align: right;">
                        <div class="invoice-details">
                            <h5 class="text-uppercase text-semibold">Invoice {{$data['dataModel']->invoice}}</h5>
                            <ul class="list-condensed list-unstyled">
                                <li>Date: <span class="text-semibold">{{$data['dataModel']->created_at->format("d/m/Y")}}</span></li>
                                <li>Payment : <span class="text-semibold">{{$data['dataModel']->payment_method}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-9 content-group">
                        <span class="text-muted">Invoice To:</span>
                         <ul class="list-condensed list-unstyled">
                            <li><h5>{{$data['dataModel']->billing_name}}</h5></li>
                            <li><span class="text-semibold">{{$data['dataModel']->billing_address}}, {{$data['dataModel']->postcode}}</span></li>
                            <li>{{$data['dataModel']->billing_city}}</li>
                            <li>{{$data['dataModel']->billing_province}}</li>
                            <li>{{$data['dataModel']->billing_phone}}</li>
                            <li><a href="#">{{$data['dataModel']->billing_email}}</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-3 content-group">
                        <span class="text-muted">Payment Details:</span>
                        <ul class="list-condensed list-unstyled invoice-payment-details">
                            <li><h5>Status: <span class="text-right text-semibold {{$data['dataModel']->BGColor}}" style="padding: 5px;border-radius: 5px;">{{$data['dataModel']->status}}</span></h5></li>
                            <li><h5>Total Due: <span class="text-right text-semibold">{{number_format($data['dataModel']->total)}}</span></h5></li>
                            {{-- <li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>
                            <li>Country: <span>United Kingdom</span></li>
                            <li>City: <span>London E1 8BF</span></li>
                            <li>Address: <span>3 Goodman Street</span></li>
                            <li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>
                            <li>SWIFT code: <span class="text-semibold">BPT4E</span></li> --}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-lg">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Description</th>
                            <th class="col-sm-1">Price</th>
                            <th class="col-sm-1">Qty</th>
                            <th class="col-sm-1">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['dataModel']->details as $item)
                        <tr>
                            <td>
                                <h6 class="no-margin">{{$item->product_name}}</h6>
                                {{-- <span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span> --}}
                            </td>
                            <td>{{number_format($item->product_price)}}</td>
                            <td>{{number_format($item->quantity)}}</td>
                            <td><span class="text-semibold">{{number_format($item->product_price*$item->quantity)}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-body" style="padding: 10px;">
                <div class="row invoice-payment">
                    <div class="col-sm-6">

                    </div>

                    <div class="col-sm-6">
                        <div class="content-group">
                            <h6>Total due</h6>
                            <div class="table-responsive no-border">
                                <table class="table">
                                    <tbody>
                                        {{-- <tr>
                                            <th>Subtotal:</th>
                                            <td class="text-right">$7,000</td>
                                        </tr> --}}
                                        {{-- <tr>
                                            <th>Tax: <span class="text-regular">(25%)</span></th>
                                            <td class="text-right">$1,750</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Total:</th>
                                            <td class="text-right text-primary"><h5 class="text-semibold">{{number_format($data['dataModel']->total)}}</h5></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right">
                                {{-- <button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Send invoice</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <h6>Note Order</h6>
                <p class="text-muted">{{$data['dataModel']->note}}</p>
                <hr>
                <h6>Other information</h6>
                <p class="text-muted">{{$profile->OrderInfo($data['dataModel']->payment_method)}}</p>
            </div>
        </div>
        <!-- /invoice template -->

    </div>
    <!-- /content area -->


</div>
<script>
window.print();

</script>
@endsection
