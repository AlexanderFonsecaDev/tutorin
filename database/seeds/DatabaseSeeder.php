<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('groups')->delete();

        $grops_name =[
            ['name' => 'Estudiantes'],
            ['name' => 'Profesores'],
        ];

        DB::table('groups')->insert($grops_name);

        DB::table('profile_statuses')->delete();

        $profiles_statuses =[
            ['name' => 'Pendiente'],
            ['name' => 'Completado'],
            ['name' => 'Rechazado'],
            ['name' => 'Verificado'],
        ];

        DB::table('profile_statuses')->insert($profiles_statuses);

        factory(App\Models\Tag::class, 30)->create();
        factory(App\Models\Category::class, 20)->create();

        factory(App\User::class,20)->create()->each(function ($user){
            $profile = $user->profile()->save(factory(App\Models\Profile::class)->make());
            $profile->location()->save(factory(App\Models\Location::class)->make());
            $user->image()->save(factory(App\Models\Image::class)->make([
                'url' => 'avatar/default.png'
            ]));

            $profile->categories()->attach($this->array(rand(1, 5)));
            $user->groups()->attach([1]);

        });


    }

    public function array($max)
    {
        $values = [];

        for ($i=1; $i < $max; $i++) {
            $values[] = $i;
        }

        return $values;
    }
}
