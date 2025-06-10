<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Food extends Model
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
}
