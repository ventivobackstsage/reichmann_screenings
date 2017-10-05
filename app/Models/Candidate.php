<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Candidate extends Model
{
    use SoftDeletes;

    public $table = 'candidates';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cnp',
        'address',
        'city',
        'country',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'address' => 'string',
        'city' => 'string',
        'country' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|between:3,32',
        'password_confirm' => 'required|same:password',
        'cnp' => 'required|integer',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        'user_id' => 'integer'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificates()
    {
        return $this->hasManyThrough(Certificate::class,Education::class);
    }
}
