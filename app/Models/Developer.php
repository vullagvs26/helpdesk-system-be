<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'position',
        'description',
    ]; 
    protected $guarded = ['id'] ; 

    public function developers() {
        return $this->hasMany(Developer::class) ; 
    }
}
