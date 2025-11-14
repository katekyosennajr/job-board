<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'company_id',
        'status',
        'user_id',
        'location',
        'job_type',
        'kategori',
        'min_salary',
        'max_salary',
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
