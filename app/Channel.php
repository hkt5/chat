<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    protected $table = 'channels';

    protected $id = 'id';
    protected $name = 'name';
    protected $creator = 'creator';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';

    protected $fillable = [
        'creator', 'name'
    ];

    public function invitations() {

        return $this->hasMany('App\Invitation');
    }

    public function messages() {

        return $this->hasMany('App\Messages');
    }

    public function moderators() {

        return $this->hasMany('App\Moderator');
    }
}
