<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * 
     *La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Relación Muchos a uno
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Relación Muchos a uno
     */
    public function image()
    {
        return $this->belongsTo('App\Image', 'image_id');
    }


}
