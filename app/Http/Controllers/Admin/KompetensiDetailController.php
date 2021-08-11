<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\Kopetensi;
use App\Model\KopetensiDetail;


class KompetensiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data['title'] = "Kopetensi Detail";
        $data['data'] = KopetensiDetail::where(['kopetensi_id' => $id])->get()->sortByDesc('id');
        $data['kopetensi'] = Kopetensi::find($id);
        return view("admin/kompetensi/detail/index",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['typeForm'] = "create";
        $data['title'] = "Kopetensi Detail";
        $data['kopetensidetail'] = KopetensiDetail::get()->sortByDesc('sort');
        $data['kopetensi'] = Kopetensi::find($id);
        return view("admin/kompetensi/detail/form",compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $data = [
            'kopetensi_id' => $id,
            'sort' => $request->sort,
            'title' => $request->title,
            'content' => $request->content,
        ];

        $data = KopetensiDetail::create($data);

        return response()->json([
            'Code'    => 200,
            'Message' => "Success Added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kompetensi,$id)
    {
        $data['dataModel'] = KopetensiDetail::find($id);
        $data['typeForm'] = "Edit";
        $data['title'] = "Kopetensi Detail";
        $data['kopetensi'] = Kopetensi::find($id_kompetensi);
        return view("admin/kompetensi/detail/form",compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id_kompetensi,Request $request, $id)
    {
        // dd($id_kompetensi);
        $data = KopetensiDetail::find($id);

        $newData = [
            'kopetensi_id' => $id_kompetensi,
            'sort' => $request->sort,
            'title' => $request->title,
            'content' => $request->content,
        ];

        $data->update($newData);

        return response()->json([
            'Code'    => 200,
            'Message' => "Edit data Success"
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
        $data = KopetensiDetail::find($id);
        $data->delete();
        
        return response()->json([
            'Code'    => 200,
            'Message' => "Delete Success"
        ]);
    }
}
