<?php

namespace App\Models\blogModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModule\User;
use App\Models\UserModule\SuperAdmin;

class BlogModel extends Model
{
    use HasFactory;

    //Belongs to User Table
    public function user()
    {
        return $this->belongsTo(User::class, "created_by", "id");
    }

    //Belongs to SuperAdmin Table
    public function super_admin()
    {
        return $this->belongsTo(SuperAdmin::class, "created_by", "id");
    }
}
