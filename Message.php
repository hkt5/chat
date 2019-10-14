<?php


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $id = 'id';
    protected $message = 'message';
    protected $chat_id = 'chat_id';
    protected $user_id = 'user_id';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';

    protected $fillable = [
        'message', 'chat_id', 'user_id', 'created_at', 'updated_at',
    ];
}
