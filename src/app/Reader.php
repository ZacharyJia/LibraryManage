<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $table = 'readers';
    protected $primaryKey = 'reader-id';
    public $timestamps = false;
}
