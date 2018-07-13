<?php

use Illuminate\Database\Seeder;

class ChildrensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Child::class, 1)->create();

        $children = App\Models\Child::all();
        foreach ($children as $child) {
            $child->parents()->sync(App\Models\ChildParent::all()->random()->id);
        }
    }
}
