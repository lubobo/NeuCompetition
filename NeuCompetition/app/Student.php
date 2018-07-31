<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * App\Student
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $num
 * @property string $class
 * @property string $cardID
 * @property string $email
 * @property string $phone_num
 * @property string $qq_num
 * @property string $birth_year
 * @property string $birth_month
 * @property integer $major_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $password
 * @property string $PM_read
 * @property string $PM_noread
 * @property string $TM_read
 * @property string $TM_noread
 * @property string $AM_read
 * @property string $AM_noread
 * @property string $AM_delete
 * @property-read \App\Major $major
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Competition[] $competition
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereCardID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereQqNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereBirthYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereBirthMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereMajorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student wherePMRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student wherePMNoread($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereTMRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereTMNoread($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereAMRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereAMNoread($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereAMDelete($value)
 *
 */

class Student extends Model
{
    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function major(){
        return $this->belongsTo('App\Major');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competition(){
        return $this->belongsToMany('App\Competition');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams(){
        return $this->belongsToMany('App\Team');
    }
}
