<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Education extends Model
{
    use SoftDeletes;

    public $table = 'education';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'candidate_id',
        'institution',
        'city',
        'Period',
        'Level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'candidate_id' => 'integer',
        'institution' => 'string',
        'city' => 'string',
        'Period' => 'string',
        'Level' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'candidate_id' => 'integer',
        'institution' => 'required',
        'city' => 'required',
        'Period' => 'required',
        'Level' => 'required'
    ];


	/**
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return $this->institution.' '.$this->Level.' ('.$this->Period.')';
	}

	/**
	 * @return string
	 */
	public function getIdCategoryAttribute()
	{
		return Education::class.'_'.$this->id;
	}

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificate()
    {
        return $this->hasMany(Certificate::class);
    }

	public function attachements()
	{
		return $this->morphMany(Attachement::class,'imageable');
	}

}
