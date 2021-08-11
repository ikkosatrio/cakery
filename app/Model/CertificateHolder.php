<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CertificateHolder extends Model
{
    protected $guarded = [];
    protected $dates = ['expired_date'];
    
    public function kopetensi()
    {
        return $this->hasOne('App\Model\Kopetensi','id', 'kopetensi_id');
    }
}
