<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->string('gender')->nullable()->after('avatar');
            $table->string('address')->nullable()->after('gender');
            $table->string('ice_cream_preference')->nullable()->after('address');
            $table->string('serving_preference')->nullable()->after('ice_cream_preference');
            $table->string('topping_preference')->nullable()->after('serving_preference');
            $table->text('flavor_suggestion')->nullable()->after('topping_preference');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'gender',
                'address',
                'ice_cream_preference',
                'serving_preference',
                'topping_preference',
                'flavor_suggestion',
            ]);
        });
    }
};