<?php

use Illuminate\Database\Seeder;
use App\Supplier;
use App\Asset;
use App\Capital;
use App\Debt;
use Carbon\Carbon;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'name' => 'Toko Kain Dianca',
            'address' => 'Jalan Cendrawasih 3 no. 12',
            'district_id' => 5781,
            'phone_number' => '087822917382',
            'business_id' => 1
        ]);

        Supplier::create([
            'name' => 'Toko Kain Furing Ivone',
            'address' => 'Jalan Hayam Wuruk 9A/22',
            'district_id' => 5780,
            'phone_number' => '08562345382',
            'business_id' => 1
        ]);

        Asset::create([
            'id' => 1,
            'business_id' => 1,
            'type' => 'Smartphone',
            'nominal' => '3000000',
            'description' => 'Smartphone XIAOMI GT2'
        ]);

        Capital::create([
            'id' => 1,
            'business_id' => 1,
            'source' => 'Personal',
            'nominal' => '10000000',
            'description' => '-'
        ]);

        Debt::create([
            'id' => 1,
            'business_id' => 1,
            'to' => 'Adinia W',
            'due' => Carbon::parse('2021-05-17'),
            'nominal' => '500000',
            'description' => '-'
        ]);
    }
}
