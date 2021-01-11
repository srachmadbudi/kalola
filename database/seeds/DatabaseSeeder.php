<?php

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
        $this->truncateMultiple(['provinces', 'cities', 'districts']);

        $this->command->comment('Seeding PROVINCES...');
        $provinces = 'database/seeds/sql/provinces.sql';
        DB::unprepared(file_get_contents($provinces));
        $this->command->info('Seeded PROVINCES.');

        $this->command->comment('Seeding CITIES...');
        $cities = 'database/seeds/sql/cities.sql';
        DB::unprepared(file_get_contents($cities));
        $this->command->info('Seeded CITIES.');

        $this->command->comment('Seeding DISTRICTS...');
        $districts = 'database/seeds/sql/districts.sql';
        DB::unprepared(file_get_contents($districts));
        $this->command->info('Seeded DISTRICTS.');

        $this->call(UserSeeder::class);
        $this->call(MasterDataSeeder::class);
        $this->call(TransactionSeeder::class);
    }

    protected function truncate($table)
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                return DB::table($table)->truncate();

            case 'pgsql':
                return  DB::statement('TRUNCATE TABLE '.$table.' RESTART IDENTITY CASCADE');

            case 'sqlite': case 'sqlsrv':
                return DB::statement('DELETE FROM '.$table);
        }

        return false;
    }

    protected function truncateMultiple(array $tables)
    {
        foreach ($tables as $table) {
            $this->truncate($table);
        }
    }
}
