<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

$roles = DB::table('roles')->get();
echo "roles-count=" . count($roles) . PHP_EOL;
foreach ($roles as $role) {
    echo $role->name . '|' . $role->guard_name . PHP_EOL;
}

$role = Role::findByName('user', 'web');
echo "findByName-user=" . ($role ? 'found' : 'missing') . PHP_EOL;
