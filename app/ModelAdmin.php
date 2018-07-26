<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelAdmin extends Model
{
  protected $table = 'users';
    protected $primaryKey = 'NIM';
}
