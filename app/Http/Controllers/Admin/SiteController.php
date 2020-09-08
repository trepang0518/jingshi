<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Site::pluck('value','key');
        return view('admin.site.index',compact('config'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token','_method','file']);
        if (empty($data)){
            return back()->withErrors(['status'=>'无数据更新']);
        }
        Site::truncate();
        foreach ($data as $key=>$val){
            Site::create([
                'key' => $key,
                'value' => $val
            ]);
        }
        return back()->with(['status'=>'更新成功']);
    }

    
}
