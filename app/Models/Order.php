<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'company_id',
        'candidate_id',
        'position',
        'reason',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'company_id' => 'integer',
        'candidate_id' => 'integer',
        'position' => 'string',
        'reason' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_id' => 'integer',
        'candidate_id' => 'integer',
        'position' => 'string',
        'reason' => 'string',
        'status' => 'string'
    ];

    public function updates()
    {
        return $this->hasMany(Update::class)->orderByDesc('id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
