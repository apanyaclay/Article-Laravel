<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'icon',
        'order_no',
        'route',
        'description',
        'is_active',
        'permission_id',
    ];

    public function submenus()
    {
        return $this->hasMany(SubMenu::class)->orderBy('order_no');
    }
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
