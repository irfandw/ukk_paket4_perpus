<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('push_subscriptions')) {
            Schema::create('push_subscriptions', function (Blueprint $table) {
                $table->id();
                $table->string('endpoint', 500);
                $table->string('p256dh', 255);
                $table->string('auth', 255);
                $table->string('role', 20)->default('anggota');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('user_agent', 255)->nullable();
                $table->timestamps();
                $table->unique(['endpoint'], 'uniq_endpoint');
                $table->index('role');
                $table->index('user_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('push_subscriptions');
    }
};
