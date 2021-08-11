<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $guarded = [];

    protected $appends 	= array('ThumbPath');

    public function getThumbPathAttribute()
    {
        $photo = Gallery::where("category_id",$this->id)->limit(1)->first();
        if($photo){
            return $photo;
        }
    }
}
