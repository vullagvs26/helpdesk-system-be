<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'full_name',
        'email',
        'ticket_no',
        'type_of_ticket',
        'impact',
        'status',
        'description',
        'image',
        'system_name_id',
        'assigned_to_id'
    ];
    
    protected $guarded = ['id']; 
    

    public function systems()
    {
        return $this->hasOne(System::class, 'id', 'system_name_id');
    }

    public function developers()
    {
        return $this->hasOne(Developer::class, 'id', 'assigned_to_id');
    }
}
