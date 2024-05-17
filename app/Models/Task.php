<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tbl_task';
    protected $guarded = [];
}
