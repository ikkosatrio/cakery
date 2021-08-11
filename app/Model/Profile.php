<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Profile extends Model //implements TranslatableContract
{
    // use Translatable;
    protected $guarded = [];
    //public $translatedAttributes = ['name','description','tag_line','WaNumber'];
    protected $appends 	= array('ImageAward');


    public function OrderInfo($method)
    {
        if($method == 'cod'){

            return $this->note_cod;
        }else if($method == 'paypal'){

            return $this->note_paypal;
        }else if($method == 'bank_transfer'){

            return $this->note_banktransfer;
        }
        return "";
    }

    public function getWaNumberAttribute()
    {
        $phone = $this->phone;
        // $phone = preg_replace('/^0?/', '+'."62", $phone);
        $phone = str_replace("-","",$phone);
        $phone = str_replace(" ","",$phone);
        $phone = str_replace("+","",$phone);
        $str = "https://wa.me/".$phone."?text=Haloo...";
        return $str;
    }

    public function getImageAwardPathAttribute()
    {
        return url('/')."/public/image/profile/".$this->image_award;
    }

}

// class ProfileTranslation extends Model {
//     public $timestamps = false;
//     protected $guarded = [];
// }
