<?php

use App\Models\Subscriptions\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Standard',
            'Professional',
            'Premium'
        ];

        foreach ($data as $record) {
            Plan::create(['name' => $record]);
        }
    }
}
