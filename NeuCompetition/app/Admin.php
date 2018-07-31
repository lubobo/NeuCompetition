<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Admin
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property integer $college_id
 * @property integer $auth
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin whereCollegeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin whereAuth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin whereUpdatedAt($value)
 */
class Admin extends Model
{
    //
}
