<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model implements  Cartable
{
    use SoftDeletes;
    protected $fillable  = ['category_id','title','slug','image','price','discount','descrition','feature_foood','status','created_by','updated_by'];
    protected $table = 'foods';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by','id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPrice(): float
    {
        // TODO: Implement getPrice() method.
    }
}
