<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSpecialisten extends Model
{
    use HasFactory;

    protected $table = "client_specialisten";

    public $timestamps = false;
}
