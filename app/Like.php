<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * 
     *La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'likes';
    
     /**
     * Relación One To Many /de uno a muchos
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /**
     * Relación Muchos a uno
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
