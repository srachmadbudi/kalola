<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Transaction;
use App\TransactionDetail;
use App\Order;
use App\OrderDetail;
use App\Consumer;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'total' => 550000,
            'date' => ('2020-12-23'),
            'description' => 'Pembelian kain merah dari supplier langganan',
            'business_id' => 1,
            'supplier_id' => 1
        ]);

        TransactionDetail::create([
            'item_name' => '50m kain merah',
            'price' => 550000,
            'quantity' => 1,
            'transaction_id' => 1
        ]);

        Transaction::create([
            'total' => 1200000,
            'date' => ('2020-12-23'),
            'description' => '100m kain furing putih',
            'business_id' => 1,
            'supplier_id' => 2
        ]);

        TransactionDetail::create([
            'item_name' => '100m kain furing putih',
            'price' => 1200000,
            'quantity' => 1,
            'transaction_id' => 2
        ]);

        Consumer::create([
            'name' => 'Hana',
            'address' => 'Jalan Raya Rungkut no. 28',
            'district_id' => 6148,
            'phone_number' => '081293374920',
            'business_id' => 1
        ]);

        Consumer::create([
            'name' => 'Rosa',
            'address' => 'Jalan Mawar Taman no. 11',
            'district_id' => 6145,
            'phone_number' => '081286930463',
            'business_id' => 1
        ]);

        Order::create([
            'status' => 0,
            'total' => 546000.00,
            'shipping_provider' => 'JNT',
            'business_id' => 1,
            'consumer_id' => 1,
            'employee_id' => 1
        ]);
    }
}
