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

            $posters = [
                [ 'Oscar Wilde', 'Be yourself; everyone else is already taken.', 'design_1', 1, 1, 'oscarwilde_beyourselfeveryone_31.png', 1 ],
                [ 'Mahatma Gandhi', 'Be the change that you wish to see in the world.', 'design_1', 1, 3, 'mahatmagandhi_bethechange_21.png', 1 ],
                [ 'Eleanor Roosevelt', 'No one can make you feel inferior without your consent.', 'design_1', 1, 2, 'eleanorroosevelt_noonecan_201.png', 2 ],
                [ 'Mahatma Gandhi', 'Live as if you were to die tomorrow. Learn as if you were to live forever.', 'design_1', 1, 4, 'mahatmagandhi_liveasif_181.png', 2 ],
            ];

            $count = count($posters);

            foreach ($posters as $key => $posterData) {
                $poster = new Poster();

                $poster->author = $posterData[0];
                $poster->quote = $posterData[1];
                $poster->design = $posterData[2];
                $poster->text_overlay = $posterData[3];
                $poster->background_id = $posterData[4];
                $poster->filename = $posterData[5];
                $poster->user_id = $posterData[6];
                $poster->created_at = Carbon::now()->subDays($count)->toDateTimeString();
                $poster->updated_at = Carbon::now()->subDays($count)->toDateTimeString();

                $poster->save();
                $count--;
            }
        }
    }
