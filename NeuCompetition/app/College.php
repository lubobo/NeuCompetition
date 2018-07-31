<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\College
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $college_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Major[] $majors
 * @method static \Illuminate\Database\Query\Builder|\App\College whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\College whereCollegeName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\College whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\College whereUpdatedAt($value)
 */
class College extends Model
{
    public function teachers(){
        return $this->hasMany('App\Teacher');
    }
    public function majors(){
        return $this->hasMany('App\Major');
    }
}
