<?php

namespace App\Models;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Other extends Model
{
    use SoftDeletes;

    public $table = 'others';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'date',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'candidate_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];



	public static function boot()
	{
		parent::boot();

		static::creating(function($model)
		{
			$model->candidate_id = Sentinel::getUser()->candidate->id;
		});
	}

	/**
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return $this->name.' '.' ('.$this->Period.')';
	}

	/**
	 * @return string
	 */
	public function getIdCategoryAttribute()
	{
		return Other::class.'_'.$this->id;
	}

    public function attachements()
    {
    	return $this->morphOne(Attachement::class,'imageable');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function candidate()
	{
		return $this->belongsTo(Candidate::class);
	}
}
