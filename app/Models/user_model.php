<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_model extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['EMŠO', 'Ime osebe', 'Država', 'Starost', 'Opis osebe'];


}
