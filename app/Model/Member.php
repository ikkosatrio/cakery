<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\MessageBag;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','token_email','email_verified_at'
    ];

    protected $appends 	= array('LinkConfirm');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getLinkConfirmAttribute()
    {
        return route("member.emailconfirm",$this->token_email);
    }

    public function sendEmailRegister()
    {
        $obj = $this;
        $data = [
            'pesan' => "Welcome to Kawaii Miam, please verify your email address.",
            'data' => $obj,
        ];

        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class, ['settings' => null]);
        $beautymail->send('mail.register', $data, function($message) use ($obj)
        {
            $message
                ->from('admin@gmail.com',"Kawaii Miam")
                ->to($obj->email, $obj->name)
                // ->cc($request->email,$request->name)
                ->subject("New Member Kawaii Miam");
        });

    }
}
