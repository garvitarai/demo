<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class compProduct extends Model
{
    protected $fillable = [
        // 'id',
        'employeeId',
        'store',
        'created_at',
        'updated_at',
        'description',
        'regularPrice',
        'salePrice',
        'internalPrice',
        'vendorCode',
        'styleCode',
        'brand',
        'colour',
        'size',
        'department',
        'status',
        'submittedBy',
        'approvedBy',
    ];

    protected $dates = ['created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'compProducts';
}
