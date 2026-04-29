<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model {

    protected $table = 'shifts';
    protected $primaryKey = 'shift_id';
    public $timestamps = true;

}
