<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 * App\Competition
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $student
 * @mixin \Eloquent
 * @property integer $competition_id
 * @property string $name
 * @property string $intro
 * @property string $com_time
 * @property string $grade
 * @property string $organizer
 * @property string $start_time
 * @property string $end_time
 * @property string $place
 * @property string $feed_back
 * @property integer $user_id
 * @property integer $team_id
 * @property integer $status
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereCompetitionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereIntro($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereComTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereGrade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereOrganizer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereFeedBack($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Competition whereCreatedAt($value)
 */
class Competition extends Model
{
    use SoftDeletes;
    public $table='competitions';

    public $primaryKey='competition_id';

    protected $fillable = ['name'];

    public $dateFormat='Y-m-d H:i:s';

    protected $guarded=[
        'competition_id',
        'name',
        'intro',
        'com_time',
        'grade',
        'organizer',
        'start_time',
        'end_time',
        'place',
        'feed_back',
        'user_id',
        'team_id',
        'status',
        'updated_at',
        'created_at',
    ];

    protected $dates=['delete_at'];

    public function student()
    {
        return $this->belongsToMany('App\Student');
    }
}
