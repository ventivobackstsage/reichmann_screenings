<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class Update extends Model
{

    public $table = 'updates';
    


    public $fillable = [
        'order_id',
        'status',
	    'Description',
	    'category',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'status' => 'string',
        'Description' => 'string',
        'user_id' => 'string',
        'category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'status' => 'required',
        'Description' => 'required',
        'user_id' => 'required'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateOnlyAttribute()
    {
    	return Carbon::parse($this->created_at)->format('M d, Y');
    }
}
