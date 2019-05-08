<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectBackgroundsAndPosters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ( 'posters', function ( Blueprint $table ) {
            //
            $table->bigInteger ( 'background_id' )->unsigned ();
            $table->foreign ( 'background_id' )->references ( 'id' )->on
            ( 'backgrounds' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ('posters', function (Blueprint $table){
            $table->dropForeign ('posters_background_id_foreign');
            $table->dropColumn ('background_id');
        });
    }
}
