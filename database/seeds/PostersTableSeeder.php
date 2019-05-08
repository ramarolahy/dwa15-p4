<?php

    use Carbon\Carbon;
    use Illuminate\Database\Seeder;
    use App\Poster;

    class PostersTableSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run () {

            //$backgrounds = ['butterflies.jpg', 'fall.jpg', 'leaves.jpg', 'road.jpg'];
            $posters = [
                [ 'Oscar Wilde', 'Be yourself; everyone else is already taken.', 1, 1, 'oscarwilde_beyourselfeveryone_01.png', null ],
                [ 'Mahatma Gandhi', 'Be the change that you wish to see in the world.', 1, 3, 'mahatmagandhi_bethechange_13.png', null ],
                [ 'Eleanor Roosevelt', 'No one can make you feel inferior without your consent.', 1, 2, 'eleanorroosevelt_noonecan_12.png', null ],
                [ 'Mahatma Gandhi', 'Live as if you were to die tomorrow. Learn as if you were to live forever.', 1, 4, 'mahatmagandhi_liveasif_14.png', null ],
                [ 'Friedrich Nietzsche', 'Without music, life would be a mistake.', 1, 2, 'friedrichnietzsche_withoutmusiclife_12.png', null ],
                [ 'Stephen Chbosky', 'We accept the love we think we deserve.', 1, 1, 'stephenchbosky_weacceptthe_11.png', null ],
            ];

            $count = count($posters);

            foreach ($posters as $key => $posterData) {
                $poster = new Poster();

                $poster->author = $posterData[0];
                $poster->quote = $posterData[1];
                $poster->text_background = $posterData[2];
                $poster->background_id = $posterData[3];
                $poster->filename = $posterData[4];
                $poster->user_id = $posterData[5];
                $poster->created_at = Carbon::now()->subDays($count)->toDateTimeString();
                $poster->updated_at = Carbon::now()->subDays($count)->toDateTimeString();

                $poster->save();
                $count--;
            }
        }
    }
