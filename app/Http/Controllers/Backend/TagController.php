<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panel = 'Tag';
        $records = Tag::all();
        return view('backend.tag.index',compact('panel','records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $panel = 'Tag';
        return view('backend.tag.create',compact('panel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        // if ($request->hasFile('image_file')){
        //     $file = $request->file('image_file');
        //     $filename = time() . '_' . $file2->getClientOriginalName();
        //     $file->move('images/category',$filename);
        //     $request->request->add(['image' => $filename]);
        // }
        $request->request->add(['image' => 'category.jpg']);
        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['updated_by' => auth()->user()->id]);
        // dd($request);
        $record = Tag::create($request->all());
         if($record){
            return redirect()->route('backend.tag.index')->with('success','Tag Creation Success!!!');
        } else {
            return redirect()->route('backend.tag.create')->with('error','Tag Creation Failed!!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $panel = 'Tag';
        $record = $tag;
        return view('backend.tag.show',compact('panel','record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $panel = 'Tag';
        $record = $tag;
        return view('backend.tag.edit',compact('panel','record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $request->request->add(['updated_by' => auth()->user()->id]);
        if($tag->update($request->all())){
            return redirect()->route('backend.tag.index')->with('success','Tag Update Success!!!');
        } else {
            return redirect()->route('backend.tag.create')->with('error','Tag Update Failed!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if($tag->delete()){
            return redirect()->route('backend.tag.index')->with('success','Tag Delete Success!!!');
        } else {
            return redirect()->route('backend.tag.create')->with('error','Tag Deletion Failed!!!');
        }
    }

    public function showTrash()
    {
        $records = Tag::onlyTrashed()->get();
        $panel = 'Tag';
        return view('backend.tag.trash',compact('panel','records'));
    }

    public function restoreTrash($id)
    {
        $record = Tag::onlyTrashed()->where('id', $id)->first();
        if($record->restore()){
            return redirect()->route('backend.tag.index')->with('success','Tag Recovered Success!!!');
        } else {
            return redirect()->route('backend.tag.trash')->with('error','Tag Recover Failed!!!');
        }
    }

    public function deleteTrash($id)
    {
        $record = Tag::onlyTrashed()->where('id', $id)->first();
        if($record->forceDelete()){
            return redirect()->route('backend.tag.trash')->with('success','Tag Deleted Permanently Success!!!');
        } else {
            return redirect()->route('backend.tag.trash')->with('error','Tag Delete Failed!!!');
        }
    }
}
