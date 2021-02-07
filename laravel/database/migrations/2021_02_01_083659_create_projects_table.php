<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type',  20)->default('local')->comment('local or ssh');
            $table->string('path');
            $table->string('host', 50)->nullable();
            $table->string('port', 5)->nullable();
            $table->string('user')->nullable();
            $table->string('auth_type', 20)->nullable()->comment('password or private_key');
            $table->string('password')->nullable();
            $table->string('private_key')->nullable();
            $table->string('passphrase')->nullable();
            $table->string('php_binary')->nullable();
            $table->text('code')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
