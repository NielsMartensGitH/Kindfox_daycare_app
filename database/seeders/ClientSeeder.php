<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->delete();
        $faker = Factory::create('nl_BE');

        $baby_images = array(
            "https://i.pinimg.com/236x/d0/ff/d4/d0ffd4b2e14f8bcb28bf470d692e4242.jpg",
            "https://media.entertainmentearth.com/assets/images/ad29594ee82f4ff2b1e2a8b00717f58dxl.jpg",
            "https://cdn.vox-cdn.com/thumbor/bfX_AtJyq9AE_V04S9sxmDuZ1dI=/1400x1050/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/19557097/bbyoda.jpg",
            "https://www.meme-arsenal.com/memes/4f2481ba0de1b5651de65884f49083f0.jpg",
            "http://pm1.narvii.com/6598/95e69992def948df3ee15c2800c2e7139cef4194_00.jpg",
            "https://ae01.alicdn.com/kf/HTB1CrSDaxrvK1RjSszeq6yObFXaI/6x6ft-Cartoon-Red-Rainbow-Baby-Jack-Custom-Photo-Studio-Seamless-Background-Backdrop-Vinyl-180cm-x-180cm.jpg",
            "https://i.ebayimg.com/images/g/-dMAAOSwEeFVFcVm/s-l400.jpg",
            "https://i.pinimg.com/originals/04/8a/12/048a123b5d4a5d81fc19188f6e77b8a1.jpg",
            "https://cdn.vox-cdn.com/thumbor/yzPdGsXFWCHbNMlDWHhPROUzVeI=/1400x1400/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/8378039/baby-groot-guardians.0.jpg",
            "https://i.gadgets360cdn.com/large/charlie_nit_my_finger_youtube_screenshot_small_1621329380493.jpg"
        );

        for ($i = 0; $i < 10; $i++) {
            $firstName = $faker->firstName('male'|'female');
            $lastName = $faker->lastName();
            $age = $faker->numberBetween(0, 12);
            $checked_in = $faker->numberBetween(0, 1);


            $client = Client::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'age' => $age,
                'checked_in' => $checked_in
            ]);

            $client->addMediaFromUrl($baby_images[$i])->toMediaCollection();
        }
    }
}
