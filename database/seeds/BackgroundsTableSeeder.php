<?php

    use Carbon\Carbon;
    use Illuminate\Database\Seeder;
    use App\Background;

    class BackgroundsTableSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run () {
            // SEE https://stackoverflow.com/questions/15774669/list-all-files-in-one-directory-php
            $path = public_path ().'/images/backgrounds';
            $backgrounds = array_diff (scandir ($path), array ('.', '..'));

            $count = count ($backgrounds);

            foreach ($backgrounds as $key => $backgroundData) {
                $background = new Background();
                $background->filename = $backgroundData;
                $background->created_at = Carbon::now ()->subDays ($count)->toDateTimeString ();
                $background->updated_at = Carbon::now ()->subDays ($count)->toDateTimeString ();

                $background->save ();
                $count--;
            }
        }
    }
