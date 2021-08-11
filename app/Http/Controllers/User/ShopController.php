<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\ProductCategory;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $data['menu'] = "Shop";
        $data['title'] = "Shop";
        $data['cart'] = \Cart::getContent();

        // \Cart::remove(4);

        $query = Product::query();
        $query = $query->where("is_ready",'1');

        if($request->category){
            $query = $query->where("category_id",$request->category);
        }

        if($request->keyword){
            $query = $query->search($request->get('keyword'));
        }

        if($request->sort == 1){
            $query = $query->orderBy('created_at', 'desc');
        }elseif($request->sort == 2){
            $query = $query->orderBy('created_at', 'asc');
        }elseif($request->sort == 3){
            $query = $query->orderBy('price', 'desc');
        }elseif($request->sort == 4){
            $query = $query->orderBy('price', 'asc');
        }elseif($request->sort == 5){

        }elseif($request->sort == 6){

        }else{
            $query = $query->orderBy('created_at', 'desc');
        }


        $data['currentParam'] = $request->all();
        $query = $query->paginate(9);
        $query = $query->appends($request->all());
        $data['product'] = $query;

        $data['category'] = ProductCategory::all();
        return view("user/shop",compact('data'));
    }

    public function checkout()
    {
        $data['menu'] = "checkout";
        $data['title'] = "Checkout";
        $data['cart'] = \Cart::getContent();
        $data['province'] = $this->getProvince();
        // dd($data);
        return view("user/checkout",compact('data'));

    }

    public function processCheckout(Request $request)
    {
        $data = [
            "invoice" => Order::GetInv("INV"),
            "billing_name" => $request->name,
            "billing_address" => $request->address,
            "billing_province" => $request->province,
            "billing_city" => $request->city,
            "billing_postcode" => $request->postcode,
            "billing_phone" => $request->phone,
            "billing_email" => $request->email,
            "total" => \Cart::getTotal(),
            "note" => $request->note,
            "payment_method" => $request->payment_method
        ];
        // dd($data);
        $data = Order::create($data);
        $data->save();


        $carts = \Cart::getContent();

        foreach ($carts as $key => $value) {
            $arrCart = [
                "order_id" => $data->id,
                "product_name" => $value->name,
                "product_price" => $value->price,
                "product_id" => $value->associatedModel->id,
                "quantity" => $value->quantity,
            ];
            $detail = OrderDetail::create($arrCart);
        }

        $data->sendOrderEmail();

        $arrData = [
            "Code" => 200,
            "Message" => "Success",
        ];
        return json_encode($arrData);
    }

    public function getCity(Request $request)
    {
        $id = $request->province_id;
        $client = new Client();
        $request = $client->get("https://pro.rajaongkir.com/api/city?province=$id&key=55debe1527da557278552dc3007fbbf3");
        $response = $request->getBody()->getContents();

        $result = json_decode($response);
        // dd($result);
        // die();
        if($result->rajaongkir->status->code == 200){
            $arrData = [
                "Code" => 200,
                "Message" => "Success",
                "Data" => $result->rajaongkir->results,
            ];
            return json_encode($arrData);
        }
    }

    public function getProvince()
    {
        $client = new Client();
        $request = $client->get("https://pro.rajaongkir.com/api/province/?key=55debe1527da557278552dc3007fbbf3");
        $response = $request->getBody()->getContents();
        $result = json_decode($response);
        if($result->rajaongkir->status->code == 200){
            return $result->rajaongkir->results;
        }
    }

    public function addtocart(Request $request)
    {

        $product = Product::find($request->id);
        // $member_id = Auth::guard('member')->user()->id;

        if(!$product){
            return json_encode(array(
                "Code" => 404,
                "Message" => "Product Not found"
            ));
        }

        // if(!$member_id){
        //     return json_encode(array(
        //         "Code" => 404,
        //         "Message" => "Member Not found"
        //     ));
        // }

        $data = [
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->FinalPrice,
            'quantity' => $request->quantity,
            'attributes' => array(),
            'associatedModel' => $product
        ];
        // dd($data);
        \Cart::add($data);

        return json_encode(array(
            "Code" => 200,
            "Message" => "Success"
        ));
    }

    public function savePaymentPaypal(Request $request)
    {
        $objPayment = json_decode($request->Payment,true);
        // dd($objPayment);


        $status = ($objPayment['status'] == 'COMPLETED') ? 'PAY' : $objPayment['status'];

        $data = [
            "invoice" => Order::GetInv("INV"),
            "billing_name" => $request->name,
            "billing_address" => $request->address,
            "billing_province" => $request->province,
            "billing_city" => $request->city,
            "billing_postcode" => $request->postcode,
            "billing_phone" => $request->phone,
            "billing_email" => $request->email,
            "total" => \Cart::getTotal(),
            "note" => $request->note,
            "payment_method" => $request->payment_method,
            'paypal_link' => $objPayment['links']['0']['href'],
            'paypal_id' => $objPayment['id'],
            'status' => $status,
        ];
        // dd($data);
        $data = Order::create($data);
        $data->save();


        $carts = \Cart::getContent();

        foreach ($carts as $key => $value) {
            $arrCart = [
                "order_id" => $data->id,
                "product_name" => $value->name,
                "product_price" => $value->price,
                "product_id" => $value->associatedModel->id,
                "quantity" => $value->quantity,
            ];
            $detail = OrderDetail::create($arrCart);
        }

        $data->sendOrderPaidEmail();

        dd($data);

        $arrData = [
            "Code" => 200,
            "Message" => "Success",
        ];
        return json_encode($arrData);
    }

    public function testemail()
    {
        $order = Order::find(16);

        $template_data = ['data' => $order];

        return view("mail.order.cake.confirm",compact('template_data'));

    }
}
