<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->string('gender')->after('last_name');
            $table->boolean('is_admin')->after('gender')
                    ->default(false);
            $table->string('avatar')->after('is_admin');
            $table->text('description')->after('avatar');
            $table->string('api_token', 80)->after('password')
                    ->unique()
                    ->nullable()
                    ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'is_admin',
                'avatar',
                'description',
                'gender',
                'api_token'
            ]);
        });
    }
}
