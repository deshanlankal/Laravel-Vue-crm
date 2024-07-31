<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'project_name',
        'project_description'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_project');
    }
}
