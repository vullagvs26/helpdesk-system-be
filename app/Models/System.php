<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'system_name',
        'published_at',
        'developed_by',
        'desciption',
    ];
    protected $guarded = ['id'] ; 

    public function systems() {
        return $this->hasMany(System::class) ; 
    }
}
