<?php

namespace App\Models\UserModule;

use App\Models\blogModule\BlogModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable
{
    use HasFactory;

    public function blog()
    {
        return $this->hasMany(BlogModel::class);
    }
}
