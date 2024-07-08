<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ticket_no',
        'type_of_ticket',
        'impact',
        'status',
        'description',
        'image',
     

    ];
    
    protected $guarded = ['id']; 
    
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'full_name_id');
        return $this->hasOne(User::class, 'id', 'email_id');
    }

    public function systems()
    {
        return $this->hasOne(System::class, 'id', 'system_name_id');
    }

    public function developers()
    {
        return $this->hasOne(Developer::class, 'id', 'assigned_to_id');
    }
}
