<?php

namespace App\Model;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];
    protected $appends 	= array('BGColor');


    public function getBGColorAttribute()
    {
        $str = "";
        switch ($this->status) {
            case 'PENDING':
                $str = "bg-blue";
                break;

            case 'CONFIRM':
                $str = "bg-orange";
                break;

            case 'PAID':
                $str = "bg-success";
                break;
            case 'COMPLETED':
                $str = "bg-indigo";
                break;

            case 'CANCEL':
                $str = "bg-warning";
                break;

            default:
                $str = "bg-indigo";
                break;
        }

        return $str;
    }

    public function sendOrderEmail()
    {
        $data = [
            "data" => $this,
        ];

        $sendto = $this->billing_email;

        try {

        $template_data = [
            'data' => $data
        ];



        Mail::send(['html' => 'mail.order.cake.order'], $data,
                        function ($message) use ($sendto,$data) {
                            $message->to($sendto)
                            ->subject('Kawaii Miam Order');
        });

        } catch (Exception $ex) {
                dd($ex->getMessage());
        }
    }

    public function sendOrderConfirmationEmail()
    {
        $data = [
            "data" => $this,
        ];

        $sendto = $this->billing_email;

        try {

        $template_data = [
            'data' => $data
        ];



        Mail::send(['html' => 'mail.order.cake.confirm'], $data,
                        function ($message) use ($sendto,$data) {
                            $message->to($sendto)
                            ->subject('Kawaii Miam Order');
        });

        } catch (Exception $ex) {
                dd($ex->getMessage());
        }
    }

    public function sendOrderPaidEmail()
    {
        $data = [
            "data" => $this,
        ];

        $sendto = $this->billing_email;

        try {

        $template_data = [
            'data' => $data
        ];



        Mail::send(['html' => 'mail.order.cake.paid'], $data,
                        function ($message) use ($sendto,$data) {
                            $message->to($sendto)
                            ->subject('Kawaii Miam Order');
        });

        } catch (Exception $ex) {
                dd($ex->getMessage());
        }
    }

    public function details()
    {
        return $this->hasMany('App\Model\OrderDetail','order_id', 'id');
    }

    public function scopeGetInv($query,$prefix)
    {
        $tipe = $prefix;
        $bulan = date('m');
        $tahun = date('Y');
        $iteration = $query->whereraw("invoice like '$tipe%$bulan-$tahun%'")
        ->max(DB::raw('substring(invoice, 5, 4)')) + 1;

        if ($iteration <= 9) {
            $kode = $tipe.'-'.'000'.($iteration).'-'.$bulan.'-'.$tahun;
        } else if ($iteration <= 99) {
            $kode =  $tipe.'-'.'00'.($iteration).'-'.$bulan.'-'.$tahun;
        } else if ($iteration <= 999) {
            $kode =  $tipe.'-'.'0'.($iteration).'-'.$bulan.'-'.$tahun;
        } else {
            $kode =  $tipe.'-'.($iteration).'-'.$bulan.'-'.$tahun;
        }
        return $kode;
    }
}
