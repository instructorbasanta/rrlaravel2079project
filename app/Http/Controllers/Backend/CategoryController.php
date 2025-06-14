<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    public $base_route = 'backend.category.';
    public $base_view = 'backend.category.';
    public $panel = 'Category';
    public $base_image_folder = 'images/category/';

    function __construct()
    {
        View::share('panel', $this->panel);
        View::share('base_route', $this->base_route);
        View::share('base_view', $this->base_view);
        View::share('base_image_folder', $this->base_image_folder);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Category::all();
        return view($this->base_route . 'index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->base_view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($this->base_image_folder, $filename);
            $request->request->add(['image' => $filename]);
        }
        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['updated_by' => auth()->user()->id]);
        $record = Category::create($request->all());
        if ($record) {
            return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Creation Success!!!');
        } else {
            return redirect()->route($this->base_route . 'create')->with('error', $this->panel . ' Creation Failed!!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $record = $category;
        return view($this->base_view . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $record = $category;
        return view($this->base_view . 'edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->request->add(['updated_by' => auth()->user()->id]);
        if ($category->update($request->all())) {
            return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Update Success!!!');
        } else {
            return redirect()->route($this->base_route . 'create')->with('error', $this->panel . ' Update Failed!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Delete Success!!!');
        } else {
            return redirect()->route($this->base_route . 'create')->with('error', $this->panel . ' Deletion Failed!!!');
        }
    }

    public function showTrash()
    {
        $records = Category::onlyTrashed()->get();
        return view($this->base_view . 'trash', compact('records'));
    }

    public function restoreTrash($id)
    {
        $record = Category::onlyTrashed()->where('id', $id)->first();
        if ($record->restore()) {
            return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Recovered Success!!!');
        } else {
            return redirect()->route($this->base_route . 'trash')->with('error', $this->panel . ' Recover Failed!!!');
        }
    }

    public function deleteTrash($id)
    {
        $record = Category::onlyTrashed()->where('id', $id)->first();
        if ($record->forceDelete()) {
            return redirect()->route($this->base_route . 'trash')->with('success', $this->panel . ' Deleted Permanently Success!!!');
        } else {
            return redirect()->route($this->base_route . 'trash')->with('error', $this->panel . ' Delete Failed!!!');
        }
    }
}
