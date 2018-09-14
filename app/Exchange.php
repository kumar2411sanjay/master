<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exchange extends Model
{
    use SoftDeletes;
    protected $table = 'exchange';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
