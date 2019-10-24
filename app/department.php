<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $fillable = [
        'employeeId',
        'department',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'departments';
}
