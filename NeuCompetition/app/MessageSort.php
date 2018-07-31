<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MessageSort
 *
 * @property integer $id
 * @property integer $sortID
 * @property string $sort_info
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messages
 * @method static \Illuminate\Database\Query\Builder|\App\MessageSort whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageSort whereSortID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageSort whereSortInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageSort whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageSort whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MessageSort extends Model
{
    public function messages(){
        return $this->hasMany('App\Message');
    }
}
