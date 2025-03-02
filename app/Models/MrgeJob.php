<?php

namespace App\Models;

use Database\Factories\MrgeJobFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrgeJob extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mrge_jobs';

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'external_id',
        'email',
        'office',
        'department',
        'recruitingCategory',
        'subcompany',
        'employmentType',
        'seniority',
        'schedule',
        'yearsOfExperience',
        'keywords',
        'occupation',
        'occupationCategory',
        'createdAt',
        'status',
    ];

    public function descriptions(){
        return $this->hasMany('App\Models\MrgeJobDescription', 'mrge_job_id');
    }
}
