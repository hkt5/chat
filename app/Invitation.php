<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{

    protected $id = 'id';
    protected $user_id = 'user_id';
    protected $channel_id = 'channel_id';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';

    protected $table = 'invitations';

    protected $fillable = [
        'user_id', 'channel_id', 'created_at', 'updated_at',
    ];

    public function channel() {

        return $this->belongsTo('App\Channel');
    }
}
