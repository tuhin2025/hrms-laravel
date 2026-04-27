<?php

use illuminate\Database\Eloquent\Model;

class regions extends Model
{
    protected $table = 'regions';
    protected $primaryKey = 'region_id';
    public $timestamps = false;
    protected $fillable = ['region_name'];

}
