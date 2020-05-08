<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ["key" => "currency", "value" => "INR"],
            ["key" => "delivery_fee", "value" => "12.5"],
            ["key" => "admin_fee_for_order_in_percent", "value" => "7"],
            ["key" => "tax_in_percent", "value" => "0"],
            ["key" => "support_email", "value" => "admin@example.com"],
            ["key" => "support_phone", "value" => "8181818118"],
            ["key" => "send_welcome_email", "value" => "1"],
            ["key" => "send_order_placed_email", "value" => "1"],
            ["key" => "send_order_complete_email", "value" => "1"],
            ["key" => "cod_enabled", "value" => "1"],
            ["key" => "delivery_fee_for_order_in_percent", "value" => "12.25"],
            ["key" => "store_fee_for_order_in_percent", "value" => "15.75"],
            ["key" => "admin_fee_for_deliver_order_in_percent", "value" => "20"],
            ["key" => "delivery_fee_deliver_order_in_percent", "value" => "35"],
            ["key" => "store_fee_deliver_in_percent", "value" => "45"],
            ["key" => "admin_fee_in_percent", "value" => "10"],

        ]);
    }
}
