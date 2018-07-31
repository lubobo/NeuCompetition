<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TeamCompetition
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $teamID
 * @property string $team_name
 * @property string $captain
 * @property string $teacher
 * @property string $com_name
 * @property integer $team_status
 * @property string $feedback
 * @property integer $captain_num
 * @property string $stu_name
 * @property integer $stu_num
 * @property string $college
 * @property string $major
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereTeamID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereTeamName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereCaptain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereTeacher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereComName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereTeamStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereFeedback($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereCaptainNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereStuName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereStuNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereCollege($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamCompetition whereMajor($value)
 * @mixin \Eloquent
 */
class TeamCompetition extends Model
{
    
}
