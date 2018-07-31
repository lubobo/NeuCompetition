<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Message
 *
 * @property integer $id
 * @property string $message_sorts_id
 * @property string $message_info
 * @property string $message_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $readed
 * @property-read \App\MessageSort $sort
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereMessageSortsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereMessageInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereMessageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereReaded($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    use SoftDeletes;
    protected $dates=['delete_at'];
    protected $guarded = [];

    public function sort(){
        return $this->belongsTo('App\MessageSort');
    }
}
