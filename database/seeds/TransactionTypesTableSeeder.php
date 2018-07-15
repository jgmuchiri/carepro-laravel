<?php

use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Stripe',
            'PayPal',
            'Cash',
            'Cheque',
            'Credit Card',
            'Debit Card',
            'Money Order',
        ];

        foreach ($data as $name) {
            \App\Models\TransactionTypes::create(['name' => $name]);
        }
    }
}
