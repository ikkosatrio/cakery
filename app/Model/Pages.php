<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class Pages extends Model
{
    protected $guarded = [];
    protected $appends 	= array('ImagePath','ImagePathSmall','ImagePathMedium','DomainName','TitleNoBr');

    public function parent()
    {
        return $this->hasOne('App\Model\Pages','id', 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Model\Pages','parent_id', 'id');
    }

    public function getTitleNoBrAttribute()
    {
        $result = $this->title;
        $result = str_replace("</br>"," - ",$result);
        $result = str_replace("<br>"," - ",$result);
        return $result;
    }

    public function getImagePathAttribute()
    {
        if(!is_file($this->ImagePathLocal()))
        {
            return $this->DefaultPath();
        }

        $url = url('/')."/public/image/pages/".$this->image;
        return $url;
    }

    public function ImagePathLocal()
    {
        $url = public_path("image/pages/".$this->image);
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
                
                $urlImage = public_path("image/pages/".$path_parts['filename']."_small.png");
                // dd($urlImage);
                $fileexist = File::exists($urlImage);
                if(!$fileexist){
                    $img = Image::make($this->getImagePathAttribute())->resize(370, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save('public/image/pages/'.$path_parts['filename']."_small.png",50);
                    // $img->encode('png');
                    // $type = 'png';
                    // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                }
                return url('/')."/public/image/pages/".$path_parts['filename']."_small.png";
            }else{
                return url('/')."/public/image/pages/".$this->image;
            }
    }

    public function getImagePathMediumAttribute(){
        if(!is_file($this->ImagePathLocal()))
        {
            return $this->DefaultPath();
        }

        $path_parts = pathinfo($this->ImagePathLocal());
        

        if(isset($path_parts['filename'])){
            
            $urlImage = public_path("image/pages/".$path_parts['filename']."_medium.png");
            // dd($urlImage);
            $fileexist = File::exists($urlImage);
            if(!$fileexist){
                $img = Image::make($this->getImagePathAttribute())->resize(945, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('public/image/pages/'.$path_parts['filename']."_medium.png",50);
                // $img->encode('png');
                // $type = 'png';
                // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
            }
            return url('/')."/public/image/pages/".$path_parts['filename']."_medium.png";
        }else{
            return url('/')."/public/image/pages/".$this->image;
        }
    }
}

