<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'tbl_stock';
    protected $guarded = [];


    public static function TotalValueNumber(){
        return DB::select("SELECT SUM(`qty`*`price`) AS total_price FROM `tbl_stock`");

    }
}
