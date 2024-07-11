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
        'description',
        'status',
    ];
    protected $dates = ['published_at', 'deleted_at']; 

    public function systems() {
        return $this->hasMany(System::class) ; 
    }
}
