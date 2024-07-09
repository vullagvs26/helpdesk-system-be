<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email', 
        'position',
    ]; 
    protected $guarded = ['id'] ; 

    public function users() {
        return $this->hasMany(User::class) ; 
    }

}
