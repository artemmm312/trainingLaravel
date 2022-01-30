<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    use HasFactory;

    /* public function allUsers()
    {
        return DB::table('users')->select('*')->get();
    } */

    protected $fillable = ['id', 'firstName', 'lastName'];
}
