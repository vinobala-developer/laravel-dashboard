<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=['name','mail_id','designation','salary','role','reference'];

      public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}
