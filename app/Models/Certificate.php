<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Certificate extends Model
{
    use SoftDeletes;

    public $table = 'certificates';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'path',
        'education_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'path' => 'string',
        'education_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'path' => 'required'
    ];


    public function education()
    {
        return $this->belongsTo(Education::class);
    }
    
}
