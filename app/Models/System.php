<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'code_name',
        'system_name',
        'owner',
        'release',
        'type',
        'deployment',
        'language',
        'framework',
        'database',
        'support_section',
        'support_developer',
        'published_at',
        'developed_by',
        'description',
        'status',
        'support_primary',
        'support_secondary',
        'support_tertiary',
        'originay_date',
        'portal_date',
        'prod_path',
        'prod_webserver',
        'prod_database',
        'dev_url',
        'dev_web',
        'dev_database',
        'back_up_url',
        'back_up_web',
        'back_up_database',
        'git_name',
        'git_server',
        'ssi_status',
        'ssi_remarks',
        'ongoing_activity',
        'developer_id',
    ];
    protected $guarded = ['id'] ; 

    public function systems() {
        return $this->hasMany(System::class) ; 
    }

    public function developers()
    {
        return $this->hasOne(Developer::class, 'id', 'developer_id');
    }
}
