<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{

    protected $table = 'moderators';

    protected $primaryKey = 'id';

    protected $id;
    protected $channel_id;
    protected $user_id;
    protected $created_at;
    protected $updated_at;

    public function channel() {

        return $this->belongsTo('App\Channel');
    }
}
