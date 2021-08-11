<?php



namespace App\Providers;



use App\Model\Pages;

use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

use Astrotomic\Translatable\Locales;

use Carbon\Carbon;

use App\Model\Profile;

use App\Model\Config;



class CakCodeServiceProvider extends ServiceProvider

{

    /**

     * Register services.

     *

     * @return void

     */

    public function register()

    {

        //

    }



    /**

     * Bootstrap services.

     *

     * @return void

     */

    public function boot()

    {

        $slug = "home-2";

        if(request()->segment(1)){

            $slug = request()->segment(1);

        }

        $profile = Profile::find(1);

        $config = Config::find(1);

        

        View::share('profile', $profile);

        View::share('config', $config);





    }

}

