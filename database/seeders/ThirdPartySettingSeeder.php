<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThirdPartySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = app(\App\Models\Settings\ThirdPartySettings::class);

        $settings->stripe_publishable_key = "pk_test_51NpzJ4IzVZalR528QleZng80HyvhCKF3yMlI2Wzcrhyc6Uz8FKXqul612Xh7FicWORVWiiBuvwJ3TUtWIn9SXho100rl3l7IUp";
        $settings->stripe_secret_key = "sk_test_51NpzJ4IzVZalR528Lu9g7WLKnzWt32Hi9TDFMcBYftuubJup7PMyGC2sSpLLxB4Vydu61du13PdBzIBZ2xBb1Oxu00vxyTYuqT";

        $settings->save();
    }
}
