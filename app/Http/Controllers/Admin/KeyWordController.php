<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\KeyWord;

class KeyWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyWord = KeyWord::with('category')->get();
        return view('admin.keywords.index',compact('keyWord'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.keywords.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key=new keyword();
        $key->fill($request->all());
        $key->save();
        return redirect()->route('keyword.index');
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
        $edit = keyword::findorfail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.keywords.edit',compact('edit', 'categories'));
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
        //
        $key= keyword::findorfail($id);
        $key->fill($request->all());
        $key->save();
        return redirect()->route('keyword.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $ids = $request->input('idCheckbox');
        if($ids != null)
            KeyWord::whereIn('id', $ids)->delete(); 
        return back();
    }

    public function active(Request $request) {
        $id = $request->input('id');
        $model = KeyWord::findorfail($id);
        $model->active = !$model->active;
        $model->save();
    }
}
