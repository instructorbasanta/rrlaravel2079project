<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Category;
use App\Models\Food;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class FoodController extends Controller
{
    public $base_route = 'backend.food.';
    public $base_view = 'backend.food.';
    public $panel = 'Food';
    public $base_image_folder = 'images/food/';

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
        $records = Food::all();
        return view($this->base_route . 'index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title','id');
        $tags = Tag::pluck('title','id');

        return view($this->base_view . 'create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
//        if ($request->hasFile('image_file')) {
//            $file = $request->file('image_file');
//            $filename = time() . '_' . $file->getClientOriginalName();
//            $file->move($this->base_image_folder, $filename);
//            $request->request->add(['image' => $filename]);
//        }
        $request->request->add(['image' => 'test.jpg']);
        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['updated_by' => auth()->user()->id]);
        DB::beginTransaction();
        try{
            $record = Food::create($request->all());
            if ($record) {
                $record->tags()->attach($request->input('tag_id'));
                DB::commit();
                return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Creation Success!!!');
            } else {
                DB::rollBack();
                return redirect()->route($this->base_route . 'create')->with('error', $this->panel . ' Creation Failed!!!');
            }
        }catch (\Exception  $exception){
            return redirect()->route($this->base_route . 'create')->with('error', $this->panel . ' Creation Failed!!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        $record = $food;
        return view($this->base_view . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        $record = $food;
        $food_tags = [];
        foreach ($food->tags as $tag){
            array_push($food_tags,$tag->id);
        }
        $tags = Tag::pluck('title','id');
        $categories = Category::pluck('title','id');
        return view($this->base_view . 'edit', compact('record','categories','tags','food_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        //        if ($request->hasFile('image_file')) {
//            $file = $request->file('image_file');
//            $filename = time() . '_' . $file->getClientOriginalName();
//            $file->move($this->base_image_folder, $filename);
//            $request->request->add(['image' => $filename]);
//        }
        $request->request->add(['image' => 'test.jpg']);
        $request->request->add(['updated_by' => auth()->user()->id]);
        DB::beginTransaction();
        try{
            if ($food->update($request->all())) {
                $food->tags()->sync($request->input('tag_id'));
                DB::commit();
                return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Update Success!!!');
            } else {
                return redirect()->route($this->base_route . 'edit',$food->id)->with('error', $this->panel . ' Update Failed!!!');
            }
        }catch (\Exception  $exception){
            DB::rollBack();
            return redirect()->route($this->base_route . 'edit',$food->id)->with('error', $this->panel . ' Update Failed!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if ($food->delete()) {
            return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Delete Success!!!');
        } else {
            return redirect()->route($this->base_route . 'create')->with('error', $this->panel . ' Deletion Failed!!!');
        }
    }

    public function showTrash()
    {
        $records = Food::onlyTrashed()->get();
        return view($this->base_view . 'trash', compact('records'));
    }

    public function restoreTrash($id)
    {
        $record = Food::onlyTrashed()->where('id', $id)->first();
        if ($record->restore()) {
            return redirect()->route($this->base_route . 'index')->with('success', $this->panel . ' Recovered Success!!!');
        } else {
            return redirect()->route($this->base_route . 'trash')->with('error', $this->panel . ' Recover Failed!!!');
        }
    }

    public function deleteTrash($id)
    {
        $record = Food::onlyTrashed()->where('id', $id)->first();
        DB::beginTransaction();
        try {
            $record->tags()->detach();
            if ($record->forceDelete()) {
                DB::commit();
                return redirect()->route($this->base_route . 'trash')->with('success', $this->panel . ' Deleted Permanently Success!!!');
            } else {
                return redirect()->route($this->base_route . 'trash')->with('error', $this->panel . ' Delete Failed!!!');
            }
        }catch (Exception $exception){
            return redirect()->route($this->base_route . 'trash')->with('error', $this->panel . ' Delete Failed!!!');
            DB::rollBack();
        }
    }
}
