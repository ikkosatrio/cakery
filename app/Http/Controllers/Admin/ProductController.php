<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->img_location = "public/image/";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Product";
        $data['data'] = Product::all()->sortByDesc('id');
        
        return view("admin/product/index",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['typeForm'] = "create";
        $data['title'] = "Product";
        $data['category'] = ProductCategory::all()->sortByDesc('id');
        return view("admin/product/form",compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $file    = $request->file('image');
            $ext     = $file->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move($this->img_location.'product',$newName);
        }else{
            $newName = NULL;
        }

        
        $data = $request->all();
        $data['image'] = $newName;
        $data = Product::create($data);
        $data->save();
        $data->slug = Str::slug($request->title.'-'.$data->id, '-');
        $data->save();
        return response()->json([
            'Code'             => 200,
            'Message'          => "Success Added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['dataModel'] = Product::find($id);
        $data['typeForm'] = "Edit";
        $data['title'] = "Product";
        $data['category'] = ProductCategory::all()->sortByDesc('id');
        return view("admin/product/form",compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        $newName = "";
        if ($request->file('image')) {

            $myFile = $this->img_location.'product/'.$data->image;
            if (file_exists($myFile)){
                @unlink($myFile);
            }

            $file    = $request->file('image');
            $ext     = $file->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move($this->img_location.'product',$newName);
            
            $newFile = [ 'image' => $newName ];
            $data->update($newFile);
        }
        // dd($request->all());
        $dataReq = $request->all();
        if($newName){
            $dataReq['image'] = $newName;
        }
        
        $dataReq['slug'] = Str::slug($dataReq['title'].'-'.$data->id, '-');
        

        $data->update($dataReq);
        $data->save();
        return response()->json([
            'Code'             => 200,
            'Message'          => "Success Added"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return response()->json([
            'Code'             => 200,
            'Message'          => "Delete Success"
        ]);
    }
}
