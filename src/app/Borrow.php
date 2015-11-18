<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'borrow';
    public $timestamps = false;

    public function book()
    {
        return $this->hasOne('\App\Book', 'book-id', 'book-id');
    }

    public function reader()
    {
        return $this->hasOne('\App\Reader', 'reader-id', 'reader-id');
    }

}
