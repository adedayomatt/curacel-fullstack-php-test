<?php

use App\Constants\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("hmo_id")->unsigned();
            $table->string("provider_name");
            $table->date("encounter_date");
            $table->enum("status", [
                Status::PENDING, Status::QUEUED, Status::FAILED, Status::SUCCESS
            ])->default(Status::PENDING);
            $table->timestamps();

            $table->foreign('hmo_id')->references('id')->on('hmos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
