<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'customer_name',
        'company',
        'email',
        'country',
        'firstAddress',
        'secondAddress'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'customer_project');
    }
}
