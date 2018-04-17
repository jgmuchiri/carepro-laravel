<?php

use Illuminate\Database\Seeder;

class InvoiceStatusesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'draft',
            'due',
            'cancelled',
            'paid'
        ];

        foreach ($data as $name) {
            \App\Models\Invoice\InvoiceStatus::create(['name' => $name]);
        }
    }
}
