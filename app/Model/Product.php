<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Nicolaslopezj\Searchable\SearchableTrait;


class Product extends Model
{
    use SearchableTrait;
    protected $guarded = [];
    protected $appends 	= array('ImagePath','ImagePathSmall','ImagePathMedium','isDiscount','FinalPrice','FinalPriceNice','PriceNice');

    protected $searchable = [
        'columns' => [
            'products.title' => 1,
            'products.content' => 1,
        ],
    ];


    public function getPriceNiceAttribute()
    {
        if ($this->price) {
            return number_format($this->price, 0);
        }
    }

    public function getFinalPriceNiceAttribute()
    {
        if ($this->FinalPrice) {
            return number_format($this->FinalPrice, 0);
        }
    }

    public function scopeGetSearch($query,$filter)
    {
        $where = "id > 0";

        $sql = "SELECT * FROM products WHERE $where";
        $data = DB::select($sql);

        $result = Product::hydrate( $data);
        return $result;
    }

    public static function GetBySlug($slug)
    {
        return Product::where([
            'slug' => $slug
        ])->first();
    }

    public static function GetRelated($product)
    {
        if($product->category_id){
            $data = Product::where([
                'category_id' => $product->category_id
            ])->orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }


        return $data;
    }

    public function Category()
    {
        return $this->hasOne('App\Model\ProductCategory', 'id', 'category_id');
    }

    public function getLinkAttribute()
    {
        return route('product.detail',$this->slug);
    }

    function getIsDiscountAttribute(){
        if ($this->price_discount > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function getFinalPriceAttribute()
    {
        if($this->isDiscount){
            return $this->price_discount;
        }else{
            return $this->price;
        }
    }

    public function getImagePathAttribute()
    {
        $url = url('/')."/public/image/product/".$this->image;
        return $url;
    }

    public function ImagePathLocal()
    {
        $url = public_path("image/product/".$this->image);
        return $url;
    }

    public function DefaultPath()
    {
        $url = url('/')."/public/image/placeholder-image.png";
        return $url;
    }



    public function getImagePathSmallAttribute(){
            if(!is_file($this->ImagePathLocal()))
            {
                return $this->DefaultPath();
            }

            $path_parts = pathinfo($this->ImagePathLocal());


            if(isset($path_parts['filename'])){

                $urlImage = public_path("image/product/".$path_parts['filename']."_small.png");
                // dd($urlImage);
                $fileexist = File::exists($urlImage);
                if(!$fileexist){
                    $img = Image::make($this->getImagePathAttribute())->resize(370, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save('public/image/product/'.$path_parts['filename']."_small.png",50);
                    // $img->encode('png');
                    // $type = 'png';
                    // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                }
                return url('/')."/public/image/product/".$path_parts['filename']."_small.png";
            }else{
                return url('/')."/public/image/product/".$this->image;
            }
    }

    public function getImagePathMediumAttribute(){
        if(!is_file($this->ImagePathLocal()))
        {
            return $this->DefaultPath();
        }

        $path_parts = pathinfo($this->ImagePathLocal());


        if(isset($path_parts['filename'])){

            $urlImage = public_path("image/product/".$path_parts['filename']."_medium.png");
            // dd($urlImage);
            $fileexist = File::exists($urlImage);
            if(!$fileexist){
                $img = Image::make($this->getImagePathAttribute())->resize(945, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('public/image/product/'.$path_parts['filename']."_medium.png",50);
                // $img->encode('png');
                // $type = 'png';
                // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
            }
            return url('/')."/public/image/product/".$path_parts['filename']."_medium.png";
        }else{
            return url('/')."/public/image/product/".$this->image;
        }
    }

}
