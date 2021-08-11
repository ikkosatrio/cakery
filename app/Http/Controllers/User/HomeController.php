<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Config;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Routing\Route;
use Astrotomic\Translatable\Locales;
use App\Model\Slide;
use App\Model\FAQ;
use App\Model\Testimoni;
use App\Model\Gallery;
use App\Model\GalleryCategory;
use App\Model\Home;
use App\Model\Appointment;
use App\Model\Kopetensi;
use App\Model\Client;
use App\Model\News;
use App\Model\Asesor;
use App\Model\CertificateHolder;
use App;
use App\Model\Product;
use Globals;
use Lang;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        $config = Config::find(1);
        SEOTools::setTitle(trans('home.title').' - '.$config->name);
        SEOTools::setDescription($config->description);
        SEOTools::opengraph()->setUrl( url('/') );
        SEOTools::addImages($config->LogoPath);
    }

    public function index(Request $request)
    {

        $data['menu'] = "home";
        $data['title'] = "Home";
        $data['slide'] = Slide::all()->sortByDesc("created_at");;
        
        $data['product'] = Product::GetSearch($request);

        return view("user/home",compact('data'));
    }

    public function sendconsult(Request $request)
    {
        $data = [
            'name'  => $request->name,
            'email'  => $request->email,
            'date'  => $request->date,
            'message'  => $request->message,
        ];

        $data = Appointment::create($data);
        $data->save();

        $this->sendConsultMail($data);

       echo json_encode(array(
            "Code" => 200,
            "Data" => "Sukses"
       ));
       return;
    }

    public function sendConsultMail($consult)
    {

        $data = [
            'pesan' => "Anda mendapat medapatkan pesan untuk request consultation di web Snoring Royal Diamond",
            'consult' => $consult,
        ];
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('mail.consult', $data, function($message) use ($consult)
        {
            $message
                ->from('info@royaldiamondclinic.com',"Royal Diamond")
                ->to("info@royaldiamondclinic.com", "Royal Diamond")
                ->cc($consult->email,$consult->name)
                ->subject("Consultation Request");
        });

    }
}
