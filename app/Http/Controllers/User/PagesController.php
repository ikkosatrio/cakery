<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CakeMenu;
use App\Model\Struktur;
use App\Model\Tempat;
use App\Model\Logo;
use App\Model\ContohSertifikat;
use App\Model\Regulasi;
use App\Model\CertificateHolder;
use App\Model\Asesor;
use App\Model\Event;
use App\Model\Client;
use App\Model\Confection;
use App\Model\Testimoni;
use App\Model\GalleryCategory;
use App\Model\Gallery;
use App\Model\Kopetensi;
use App\Model\KopetensiDetail;
use App\Model\News;
use App\Model\NewsCategory;
use App\Model\Config;
use App\Model\ContactMessage;
use App\Model\FAQ;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Routing\Route;

class PagesController extends Controller
{
    public function cakemenu()
    {

        $data['menu'] = "visimisi";
        $data['title'] = "Visi & Misi";
        $data['data'] = CakeMenu::find(1);
        return view("user/cakemenu",compact('data'));
    }

    public function confection()
    {

        $data['menu'] = "confection";
        $data['title'] = "Confection";
        $data['data'] = Confection::find(1);
        return view("user/confection",compact('data'));
    }

    public function faq()
    {

        $data['menu'] = "faq";
        $data['title'] = "FAQ";
        $data['data'] = FAQ::all();
        return view("user/faq",compact('data'));
    }

    public function struktur()
    {

        $data['menu'] = "struktur";
        $data['title'] = "Struktur Organisasi";
        $data['data'] = Struktur::find(1);
        return view("user/pages",compact('data'));
    }

    public function tempat()
    {

        $data['menu'] = "tempat";
        $data['title'] = "Tempat Uji Kompetensi";
        $data['data'] = Tempat::find(1);
        return view("user/pages",compact('data'));
    }

    public function logo()
    {

        $data['menu'] = "logo";
        $data['title'] = "Logo & Arti Logo";
        $data['data'] = Logo::find(1);
        return view("user/pages",compact('data'));
    }

    public function contohsertifikat()
    {

        $data['menu'] = "contohsertifikat";
        $data['title'] = "Contoh Sertifikat";
        $data['data'] = ContohSertifikat::find(1);
        return view("user/pages",compact('data'));
    }

    public function regulasi()
    {

        $data['menu'] = "regulasi";
        $data['title'] = "Regulasi";
        $data['data'] = Regulasi::find(1);
        return view("user/pages",compact('data'));
    }

    public function pemegang()
    {

        $data['menu'] = "pemegang";
        $data['title'] = "Pemegang Sertifikat";
        $data['data'] = CertificateHolder::all();
        return view("user/pemegang",compact('data'));
    }

    public function asesor()
    {

        $data['menu'] = "asesor";
        $data['title'] = "Asesor Kompetensi";
        $data['data'] = Asesor::all();
        return view("user/asesor",compact('data'));
    }

    public function testimoni()
    {

        $data['menu'] = "testimoni";
        $data['title'] = "Testimoni";
        $data['data'] = Testimoni::all();
        return view("user/testimoni",compact('data'));
    }

    public function aboutus()
    {

        $data['menu'] = "aboutus";
        $data['title'] = "About Us";
        return view("user/aboutus",compact('data'));
    }

    public function skema()
    {

        $data['menu'] = "skema";
        $data['title'] = "Skema";
        $data['data'] = Kopetensi::all();
        return view("user/skema",compact('data'));
    }

    public function skemadetail($slug)
    {

        $data['menu'] = "skema";
        $data['title'] = "Skema";
        $data['kopetensi'] = Kopetensi::where("slug",$slug)->limit(1)->first();
        $data['data'] = KopetensiDetail::where("kopetensi_id",$data['kopetensi']->id)->get();
        return view("user/skemadetail",compact('data'));
    }

    public function event()
    {

        $data['menu'] = "event";
        $data['title'] = "Event";
        $data['data'] = Event::all();
        return view("user/event",compact('data'));
    }

    public function contactstore(Request $request)
    {
        try{
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'message' => $request->message
            ];

            $data = ContactMessage::create($data);

            $this->MailNotification($data);

            return response()->json([
                'Code'             => 200,
                'Message'          => "Success"
            ]);
        } catch (Esception $e) {
            return response()->json([
                'Code'             => 401,
                'Message'          => $e->getMessage()
            ]);
        }
    }

    public function MailNotification($request)
    {
        $data = [
            'pesan' => "Anda mendapat pesan jon",
            'request' => $request,
        ];

        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class, ['settings' => null]);
        $beautymail->send('mail.notif', $data, function($message) use ($request)
        {
            $message
                ->from('raywhitebukitdarmogolf@gmail.com',"Ray White Bukit Darmo Golf")
                ->to($request->email, $request->name)
                // ->cc($request->email,$request->name)
                ->subject("Consultation Request");
        });
    }

    public function contact()
    {

        $data['menu'] = "contact";
        $data['title'] = "Contact";
        // $data['client'] = Client::all();
        return view("user/contact",compact('data'));
    }

    public function gallery()
    {

        $data['menu'] = "gallery";
        $data['title'] = "Gallery";
        $data['data'] = GalleryCategory::all();
        return view("user/gallery",compact('data'));
    }

    public function gallerydetail($id)
    {

        $data['menu'] = "event";
        $data['title'] = "Event";
        $data['category'] = GalleryCategory::find($id);
        $data['data'] = Gallery::where("category_id",$id)->get();
        return view("user/gallerydetail",compact('data'));
    }

    public function news(Request $request)
    {

        $data['menu'] = "news";
        $data['title'] = "News";
        $data['news_categories'] = NewsCategory::orderBy('created_at', 'desc')->get();

        $query = News::query();

        if($request->has('search')){
            $query = $query->search($request->get('search'));
        }

        if($request->has('category')){
            $query = $query->where("category_id",$request->category);
        }

        $query = $query->orderBy('created_at', 'desc')->paginate(5);

        $data['news'] = $query;
        return view("user/news",compact('data'));
    }

    public function newsdetail($slug)
    {

        $data['menu'] = "news";
        $data['title'] = "News";
        $config = Config::find(1);
        $data['news_categories'] = NewsCategory::orderBy('created_at', 'desc')->get();
        $data['news'] = News::where("slug",$slug)->limit(1)->first();

        if(!$data['news']){
            return abort(404);
        }

        SEOTools::opengraph()->setUrl( route("news_detail",$slug) );
        SEOTools::setTitle($data['news']->title.' - '.$config->name);
        SEOTools::setDescription(str_limit(strip_tags($data['news']->description), 80));
        if($data['news']->ImagePathSmall && isset($data['news']->ImagePathSmall)){
            SEOTools::addImages($data['news']->ImagePathSmall);
        }else{
            SEOTools::addImages($config->LogoPath);
        }
        return view("user/newsdetail",compact('data'));
    }
}
