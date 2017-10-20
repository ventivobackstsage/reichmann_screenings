<?php

namespace App\Models;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;

    public $table = 'companies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'slug',
        'name',
        'address',
        'reg_com',
        'vat_code',
	    'phone',
	    'discount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'slug' => 'string',
        'name' => 'string',
        'address' => 'string',
        'reg_com' => 'string',
        'vat_code' => 'string',
        'phone' => 'string',
        'discount' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
	    'name' => 'required',
	    'vat_code' => 'required',
    ];


	public static function boot()
	{
		parent::boot();

		static::creating(function($model)
		{
			$model->user_id = Sentinel::getUser()->id;
		});
	}

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

	public function user()
	{
		return $this->hasMany(User::class,'entity_id');
	}

}
