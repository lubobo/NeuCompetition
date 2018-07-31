<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Major
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $major_name
 * @property integer $college_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read \App\College $college
 * @method static \Illuminate\Database\Query\Builder|\App\Major whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Major whereMajorName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Major whereCollegeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Major whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Major whereUpdatedAt($value)
 */
class Major extends Model
{
    public function students(){
        return $this->hasMany('App\Student');
    }
    public function college(){
        return $this->belongsTo('App\College');
    }
}
