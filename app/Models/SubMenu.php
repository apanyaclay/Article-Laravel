<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class SubMenu extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'name',
        'order_no',
        'route',
        'description',
        'is_active',
        'permission_id',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
