<?php

namespace Database\Seeders\EDU;

use App\Models\EDU\Label\Label;
use App\Models\EDU\Programme\Programme;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Programme::factory()->count(2)->create();

        $programmes = Programme::all();
        $courses = Programme::all()->pluck('id');
        $labels = Label::all()->pluck('id');
        $users = User::where('last_name', '!=', 'Account')->get()->pluck('id');

        foreach ($programmes as $programme) {
           $programme->courses()->attach($courses);
           break;
        }

        foreach ($programmes as $programme) {
            $programme->labels()->attach($labels);
            break;
        }

        foreach ($programmes as $programme) {
            $programme->participants()->attach($users);
            break;
        }
    }
}
