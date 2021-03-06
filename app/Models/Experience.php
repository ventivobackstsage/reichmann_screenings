<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Experience extends Model
{
    use SoftDeletes;

    public $table = 'experiences';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'candidate_id',
        'Company',
        'Period',
        'Position',
        'info'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'candidate_id' => 'integer',
        'Company' => 'string',
        'Period' => 'string',
        'Position' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'candidate_id' => 'integer',
        'Company' => 'required',
        'Period' => 'required',
        'Position' => 'required'
    ];

	/**
	 * @return string
	 */
	public function getIdCategoryAttribute()
	{
		return Experience::class.'_'.$this->id;
	}

	/**
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return $this->Company.' '.$this->Position.' ('.$this->Period.')';
	}

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

	public function attachements()
	{
		return $this->morphMany(Attachement::class,'imageable');
	}
}
