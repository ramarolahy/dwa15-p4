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
                $table->string ( 'author');
                $table->string ( 'quote' );
                $table->string ( 'design' )->default ('design_1');
                $table->boolean ( 'text_overlay' );
                $table->string('filename');
                $table->timestamps ();
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
