<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Define the tables to be updated, excluding Laravel's default tables
        $tables = [
            'ads',
            'bids',
            'categories',
            'cities',
            'coins',
            'countries',
            'easypaisas',
            'favorites',
            'feedbacks',
            'jazz_cashes',
            'localities',
            'model_has_permissions',
            'model_has_roles',
            'newsletters',
            'permissions',
            'professions',
            'reports',
            'roles',
            'role_has_permissions',
            'users'
        ];

        // Loop through each table and add the columns
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
