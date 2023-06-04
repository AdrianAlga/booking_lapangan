<?php

use App\Models\User;
use App\Models\Field;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Field::class);
            $table->foreignIdFor(User::class);
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('costumer_name');
            $table->string('phone');
            $table->enum('status', ['Pending', 'Waiting For Payment', 'Confirmed', 'Cancelled'])->default('Pending');
            $table->string('confirm_payment')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
