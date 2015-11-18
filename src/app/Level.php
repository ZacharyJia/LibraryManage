<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $primaryKey = 'level';
    protected $table = 'member-level';
    public $timestamps = false;
}
