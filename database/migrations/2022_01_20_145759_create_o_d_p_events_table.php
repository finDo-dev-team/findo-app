<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateODPEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_d_p_events', function (Blueprint $table) {
            $table->id();
            $table->string("odpID")->nullable();
            $table->text("url")->nullable();
            $table->text("title")->nullable();
            $table->text("lead_text")->nullable();
            $table->text("description")->nullable();
            $table->dateTime("date_start")->nullable();
            $table->dateTime("date_end")->nullable();
            $table->text("occurrences")->nullable();
            $table->text("date_description")->nullable();
            $table->text("cover_url")->nullable();
            $table->text("cover_alt")->nullable();
            $table->text("cover_credit")->nullable();
            $table->text("tags")->nullable();
            $table->text("address_name")->nullable();
            $table->text("address_street")->nullable();
            $table->text("address_zipcode")->nullable();
            $table->text("address_city")->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer("pmr")->nullable();
            $table->integer("blind")->nullable();
            $table->integer("deaf")->nullable();
            $table->text("transport")->nullable();
            $table->text("contact_url")->nullable();
            $table->text("contact_phone")->nullable();
            $table->text("contact_mail")->nullable();
            $table->text("contact_facebook")->nullable();
            $table->text("contact_twitter")->nullable();
            $table->text("price_type")->nullable();
            $table->text("price_detail")->nullable();
            $table->text("access_type")->nullable();
            $table->dateTime("odp_updated_at")->nullable();
            $table->text("programs")->nullable();
            $table->text("address_url")->nullable();
            $table->text("title_event")->nullable();
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
        Schema::dropIfExists('o_d_p_events');
    }
}
