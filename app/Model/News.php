<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Model\News;

class News extends Model
{
    use SearchableTrait;
    protected $guarded = [];
    protected $appends 	= array('ImagePath','ImagePathSmall','ImagePathMedium','ShareFacebook','ShareTwitter','ShareWhatsapp');

    public function Category()
    {
        return $this->hasOne('App\Model\NewsCategory', 'id', 'category_id');
    }

    public function getShareWhatsappAttribute(){
        $url = url('news')."/".$this->slug;
        return "https://api.whatsapp.com/send?text=".$url;
    }

    public function getShareTwitterAttribute(){
        $url = url('news')."/".$this->slug;
        return "https://twitter.com/intent/tweet?text=&amp;url=".$url;
    }

    public function getShareFacebookAttribute(){
        $url = url('news')."/".$this->slug;
        return "https://www.facebook.com/sharer/sharer.php?u=".$url;
    }

    public function getImagePathAttribute()
    {
        $url = url('/')."/public/image/news/".$this->image;
        return $url;
    }

    public function ImagePathLocal()
    {
        $url = public_path("image/news/".$this->image);
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
                
                $urlImage = public_path("image/news/".$path_parts['filename']."_small.png");
                // dd($urlImage);
                $fileexist = File::exists($urlImage);
                if(!$fileexist){
                    $img = Image::make($this->getImagePathAttribute())->resize(370, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save('public/image/news/'.$path_parts['filename']."_small.png",50);
                    // $img->encode('png');
                    // $type = 'png';
                    // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                }
                return url('/')."/public/image/news/".$path_parts['filename']."_small.png";
            }else{
                return url('/')."/public/image/news/".$this->image;
            }
    }

    public function getImagePathMediumAttribute(){
        if(!is_file($this->ImagePathLocal()))
        {
            return $this->DefaultPath();
        }

        $path_parts = pathinfo($this->ImagePathLocal());
        

        if(isset($path_parts['filename'])){
            
            $urlImage = public_path("image/news/".$path_parts['filename']."_medium.png");
            // dd($urlImage);
            $fileexist = File::exists($urlImage);
            if(!$fileexist){
                $img = Image::make($this->getImagePathAttribute())->resize(945, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('public/image/news/'.$path_parts['filename']."_medium.png",50);
                // $img->encode('png');
                // $type = 'png';
                // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
            }
            return url('/')."/public/image/news/".$path_parts['filename']."_medium.png";
        }else{
            return url('/')."/public/image/news/".$this->image;
        }
    }
}
