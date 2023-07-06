<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, HasRoles;

    protected $guarded = [];
}
