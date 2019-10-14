<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $primaryKey = 'id';

    protected $id = 'id';
    protected $message = 'message';
    protected $user_id = 'user_id';
    protected $channel_id = 'channel_id';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';

    protected $fillable = [
        'user_id', 'channel_id', 'message', 'created_at', 'updated_at',
    ];

    public function channel() {

        return $this->belongsTo('App\Channel');
    }
}
