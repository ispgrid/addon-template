<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

/**
 * The add-on's permission boxes. No role gets them here: Admin has every box, and operators tick the rest on Roles.
 */
return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        foreach (['view-hello', 'manage-hello'] as $name) {
            DB::table('permissions')->insertOrIgnore(['name' => $name, 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now]);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        // Nothing: removing boxes would change what roles can do. --delete-data forgets this migration instead.
    }
};
