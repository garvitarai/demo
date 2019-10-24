<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class compProductPics extends Model
{
    protected $fillable = [
        'productId',
        'type',
        'comments',
        'created_at',
        'updated_at',
        'picture',
    ];

    public function product()
    {
      return $this->belongsTo('App\compProduct');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'pictures';
}
