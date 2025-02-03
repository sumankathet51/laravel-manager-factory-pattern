<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}
