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
        'profile_photo',
    ]; 
    protected $guarded = ['id'] ; 

  
    public function ticket_active() {
        return $this->hasMany(Ticket::class ,   'assigned_to_id', 'id') ->where('status','Active') ; 
    }
    public function ticket_ongoing() {
        return $this->hasMany(Ticket::class ,   'assigned_to_id', 'id') ->where('status','On-going') ; 
    }
    public function ticket_closed() {
        return $this->hasMany(Ticket::class ,   'assigned_to_id', 'id') ->where('status','Closed') ; 
    }
    
    
}
