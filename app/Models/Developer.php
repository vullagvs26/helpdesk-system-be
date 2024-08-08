<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Developer extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'position',
        'description',
        'password',
        'profile_photo',
    ]; 
    protected $guarded = ['id'] ; 

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
  
    public function ticket_active() {
        return $this->hasMany(Ticket::class ,   'assigned_to_id', 'id') ->where('status','Active') ; 
    }
    public function ticket_ongoing() {
        return $this->hasMany(Ticket::class ,   'assigned_to_id', 'id') ->where('status','On-going') ; 
    }
    public function ticket_closed() {
        return $this->hasMany(Ticket::class ,   'assigned_to_id', 'id') ->where('status','Closed') ; 
    }
    public function developers() {
        return $this->hasMany(Developer::class) ; 
    }
}
