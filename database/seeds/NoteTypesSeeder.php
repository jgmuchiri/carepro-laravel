<?php

use App\Models\Notes\Type;
use Illuminate\Database\Seeder;

class NoteTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Incident', 'General'];
        foreach ($names as $name) {
            Type::firstOrCreate(['name' => $name]);
        }
    }
}
