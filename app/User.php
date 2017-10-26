<?php namespace App;
use App\Models\Attachement;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Update;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentTaggable\Taggable;
use Lab404\Impersonate\Models\Impersonate;


class User extends EloquentUser {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'users';

	/**
	 * The attributes to be fillable from the model.
	 *
	 * A dirty hack to allow fields to be fillable by calling empty fillable array
	 *
	 * @var array
	 */
    use Taggable;

    use Impersonate;

	protected $fillable = [];
	protected $guarded = ['id'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	* To allow soft deletes
	*/
	use SoftDeletes;

    protected $dates = ['deleted_at'];


	public function company()
	{
		return $this->hasOne(Company::class,'id','entity_id');
	}

	public function candidate()
	{
		return $this->hasOne(Candidate::class);
	}

	public function updates()
	{
		return $this->hasMany(Update::class);
	}

	public function attachements()
	{
		return $this->hasMany(Attachement::class);
	}

	public function getFullNameAttribute()
	{
		return $this->first_name.' '.$this->last_name;
	}

}
