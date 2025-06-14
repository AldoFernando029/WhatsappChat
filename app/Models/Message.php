<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'message', 'attachment', 'reply_to'
    ];

    public function repliedMessage()
    {
        return $this->belongsTo(Message::class, 'reply_to');
    }
}
?>