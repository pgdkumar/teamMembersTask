<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
	protected $table = 'details';
    protected $fillable = [
        'user_id', 'team_members', 'status'
    ];

}
