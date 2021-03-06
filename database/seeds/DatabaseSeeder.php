<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //required seeders
        $this->call(PlansTableSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RolesToPermissionsTableSeeder::class);
        $this->call(AdminUserAccountSeeder::class);
        $this->call(BloodTypesSeeder::class);
        $this->call(EthnicitiesSeeder::class);
        $this->call(GendersSeeder::class);
        $this->call(ReligionsSeeder::class);
        $this->call(StatusesSeeder::class);
        $this->call(InvoiceStatusesTablesSeeder::class);
        $this->call(NoteTypesSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        //fake data seeders
        // $this->call(StaffTableSeeder::class);
        // $this->call(ParentsTableSeeder::class);
    }
}
