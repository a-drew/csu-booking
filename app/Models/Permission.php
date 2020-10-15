<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as BasePermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends BasePermission
{
    use HasFactory;
}