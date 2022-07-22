<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $table = "notifications";

    public $fillable = [
        'user_id',
        'title',
        'text',
        'image',
        'show',
        'read',
        'uid',
        'delete',
    ];
}
