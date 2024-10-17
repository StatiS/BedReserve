<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    // Laravel uses conventions to link this to db. By default, it uses the plural of the class name.
    // But to define a custom table name to link to, you just do this
    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary'];

    use HasFactory;
}
