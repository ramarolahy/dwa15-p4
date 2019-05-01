<?php

    use Carbon\Carbon;
    use Illuminate\Database\Seeder;
use App\Background;

class BackgroundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $backgrounds = ['butterflies.jpg', 'fall.jpg', 'leaves.jpg', 'road.jpg'];

       $count = count($backgrounds);

       foreach ($backgrounds as $key => $backgroundData) {
           $background = new Background();
           $background->filename = $backgroundData;
           $background->created_at = Carbon::now()->subDays($count)->toDateTimeString();
           $background->updated_at = Carbon::now()->subDays($count)->toDateTimeString();

           $background->save ();
           $count--;
       }
    }
}
