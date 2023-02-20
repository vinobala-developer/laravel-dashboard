<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
// User class in Auth

class User extends Authenticable // by default this extends model
{
    use HasFactory;

    public function employeeRef()
    {
        return $this->hasMany(Employee::class);
    }
}
