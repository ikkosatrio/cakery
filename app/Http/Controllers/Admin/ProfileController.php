<?php

namespace App\Http\Controllers\Admin;

use App\Model\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Profile";
        $typeForm = "edit";
        $dataModel = Profile::find(1);
        return view("admin/profile/index",compact('title','typeForm','dataModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        try {
            $data = Profile::find(1);

            // if ($request->location != '[object Object]') {

            //     $new_loc = substr($request->location, 1, -1);
            //     $latlong = explode(",",$new_loc);
            //     $lat     = $latlong['0'];
            //     $long    = substr($latlong['1'], 1);

            //     $newdata = [
            //         'latitude' => $lat,
            //         'longitude' => $long
            //     ];
            //     $data->update($newdata);
            // }

            $newdata = [
                'name'             => $request->name,
                'description'          => $request->description,
                // 'tag_line'          => $request->tag_line,
                'address'          => $request->address,

                'note_banktransfer'          => $request->note_banktransfer,
                'note_paypal'          => $request->note_paypal,
                'note_cod'          => $request->note_cod,

                'email'            => $request->email,
                'phone'            => $request->phone,
                'social_facebook'  => $request->social_facebook,
                'social_twitter'   => $request->social_twitter,
                'social_instagram' => $request->social_instagram,
                'social_wechat'    => $request->social_wechat,
                'social_wa'        => $request->social_wa,
            ];
            $data->update($newdata);


            // if ($request->file('imgaward')) {
            //     $myFile            =  "public/image/profile/".$data->image_award;
            //     if ($data->image_award) {
            //         @unlink($myFile);
            //     }

            //     $file              =  $request->file('imgaward');
            //     $ext               =  $file->getClientOriginalExtension();
            //     $newName           =  rand(100000,1001238912).".".$ext;
            //     $file->move('public/image/profile',$newName);

            //     $newdata           =  [ 'image_award' => $newName ];
            //     $data->update($newdata);
            // }


            $data->save();

            return response()->json([
                'Code'             => 200,
                'Message'          => "Success updated"
            ]);
        } catch (Esception $e) {
            return response()->json([
                'Code'             => 401,
                'Message'          => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
