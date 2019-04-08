<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'description', 
        'user_id',
        'publish_time',
        'auto_publish',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    /**
     * guarded fields
     * these fields can not be changed value
     */
    protected $guarded = [
        'user_id'
    ];
    /**
     * posts
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
