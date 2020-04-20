<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TermsTableSeeder::class);
        $this->call(TermTaxonomySeeder::class);
        $this->call(RoleTableSeed::class);
        $this->call(UsersTableSeeds::class);
        $this->call(OptionsTableSeed::class);
    }
}
