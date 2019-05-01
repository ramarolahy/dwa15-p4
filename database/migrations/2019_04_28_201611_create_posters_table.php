<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreatePostersTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up () {
            Schema::create ( 'posters', function ( Blueprint $table ) {
                $table->engine = 'InnoDB'; // To allow foreign key.
                $table->bigIncrements ( 'id' );
                $table->string ( 'author' );
                $table->string ( 'quote' );
                $table->boolean ( 'text_background' );
                $table->bigInteger ( 'background_id' )->unsigned ();
                $table->string('filename');
                $table->timestamps ();
            } );

            Schema::table ( 'posters', function ( Blueprint $table ) {
                $table->foreign ( 'background_id' )->references ( 'id' )->on
                ( 'backgrounds' )->onDelete('cascade');
            } );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down () {
            Schema::dropIfExists ( 'posters' );
        }
    }
