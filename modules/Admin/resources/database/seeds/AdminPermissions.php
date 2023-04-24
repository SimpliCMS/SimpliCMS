<?php

namespace Modules\Admin\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Konekt\Acl\Models\Permission;

class AdminPermissions extends Seeder {

    private $permissions = [
        'access admin',
    ];

    public function run() {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

}
