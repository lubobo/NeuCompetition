<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Team
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $teamID
 * @property integer $competition_id
 * @property integer $teacher_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $team_info
 * @property integer $leaderID
 * @property string $deleted_at
 * @property integer $team_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read \App\Teacher $teacher
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereTeamID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCompetitionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereTeamInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereLeaderID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereTeamCount($value)
 */

class Team extends Model
{
    use SoftDeletes;
    protected $dates=['delete_at'];
    protected $guarded=[];

    public function students(){
        return $this->belongsToMany('APP\Student');
    }
    public function teacher(){
        return $this->belongsTo('App\Teacher');
    }
    public function team_info(){
        echo $this->teamID;
    }
}
