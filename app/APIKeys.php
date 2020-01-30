<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APIKeys extends Model
{
    protected $table="a_p_i_keys";
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['key', 'value'];

}
