<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Category extends Model
{
    use SoftDeletes;
    protected $fillable  = ['title','slug','rank','image','icon','description','status','created_by','updated_by'];
    protected $table = 'categories';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by','id');
    }
}
