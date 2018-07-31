<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Teacher
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $num
 * @property string $subject
 * @property string $job
 * @property string $job_title
 * @property string $email
 * @property string $phone_num
 * @property string $qq_num
 * @property integer $college_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $password
 * @property string $PM_read
 * @property string $PM_noread
 * @property string $AM_read
 * @property string $AM_noread
 * @property-read \App\College $college
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereJob($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereJobTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereQqNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereCollegeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher wherePMRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher wherePMNoread($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereAMRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereAMNoread($value)
 */
class Teacher extends Model
{
    protected $guarded=[];
    public function college(){
        return $this->belongsTo('App\College');
    }
    public function teams(){
        return $this->hasMany('App\Team');
    }
}
