<?php

namespace App\Model;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Service extends Model
{
    protected $guarded = [];
    protected $appends 	= array('ImagePath','ImagePathSmall','ImagePathMedium','ColorBG');

    public function pages()
    {
        return $this->hasOne('App\Model\Pages','id', 'pages_id');
    }

    public function getImagePathAttribute()
    {
        $url = url('/')."/public/image/service/".$this->image;
        return $url;
    }

    public function ImagePathLocal()
    {
        $url = public_path("image/service/".$this->image);
        return $url;
    }

    public function DefaultPath()
    {
        $url = url('/')."/public/image/placeholder-image.png";
        return $url;
    }


    public function getColorBGAttribute()
    {
        $colorString = "#e74c3c";
        if(($this->id % 2) == 0){
            $colorString = "#2ecc71";
        }else if(($this->id % 3) == 0){
            $colorString = "#3498db";
        }else if(($this->id % 4) == 0){
            $colorString = "#e74c3c";
        }else if(($this->id % 5) == 0){
            $colorString = "#f1c40f";
        }
        return $colorString;
    }


    public function getImagePathSmallAttribute(){
        if(!is_file($this->ImagePathLocal()))
        {
            return $this->DefaultPath();
        }

        $path_parts = pathinfo($this->ImagePathLocal());


        if(isset($path_parts['filename'])){

            $urlImage = public_path("image/service/".$path_parts['filename']."_small.png");
            // dd($urlImage);
            $fileexist = File::exists($urlImage);
            if(!$fileexist){
                $img = Image::make($this->getImagePathAttribute())->resize(370, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('public/image/service/'.$path_parts['filename']."_small.png",50);
                // $img->encode('png');
                // $type = 'png';
                // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
            }
            return url('/')."/public/image/service/".$path_parts['filename']."_small.png";
        }else{
            return url('/')."/public/image/service/".$this->image;
        }
    }

    public function getImagePathMediumAttribute(){
        if(!is_file($this->ImagePathLocal()))
        {
            return $this->DefaultPath();
        }

        $path_parts = pathinfo($this->ImagePathLocal());


        if(isset($path_parts['filename'])){

            $urlImage = public_path("image/service/".$path_parts['filename']."_medium.png");
            // dd($urlImage);
            $fileexist = File::exists($urlImage);
            if(!$fileexist){
                $img = Image::make($this->getImagePathAttribute())->resize(945, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('public/image/service/'.$path_parts['filename']."_medium.png",50);
                // $img->encode('png');
                // $type = 'png';
                // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
            }
            return url('/')."/public/image/service/".$path_parts['filename']."_medium.png";
        }else{
            return url('/')."/public/image/service/".$this->image;
        }
    }
}
