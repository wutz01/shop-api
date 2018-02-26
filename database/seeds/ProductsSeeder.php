<?php

use Illuminate\Database\Seeder;
use App\Supplier;
use App\Category;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1 = new Category;
        $cat1->name = 'Electronic Device';
        $cat1->description = 'Devices';
        $cat1->save();

        $cat2 = new Category;
        $cat2->name = 'Sports & Travel';
        $cat2->description = 'Wearable and sports';
        $cat2->save();

        $cat3 = new Category;
        $cat3->name = 'Audio Devices';
        $cat3->description = 'Audio';
        $cat3->save();

        $cat4 = new Category;
        $cat4->name = 'Video Devices';
        $cat4->description = 'Video';
        $cat4->save();

        $sup1 = new Supplier;
        $sup1->name = 'MowBow';
        $sup1->address = 'Makati';
        $sup1->currency = 'PHP';
        $sup1->save();

        $sup2 = new Supplier;
        $sup2->name = 'BowWow';
        $sup2->address = 'Japan';
        $sup2->currency = 'Yen';
        $sup2->save();

        $sup3 = new Supplier;
        $sup3->name = 'Glooble';
        $sup3->address = 'Florida, USA';
        $sup3->currency = 'USD';
        $sup3->save();

        $sup4 = new Supplier;
        $sup4->name = 'White Gadgeteer';
        $sup4->address = 'United Kingdom';
        $sup4->currency = 'GBP';
        $sup4->save();

        $pro1 = new Product;
        $pro1->name = 'Speaker';
        $pro1->description = '7.1 Surround Sound';
        $pro1->price = 500.00;
        $pro1->supplier_id = $sup1->id;
        $pro1->save();
        $pro1->categories()->sync([$cat1->id, $cat3->id]);

        $pro2 = new Product;
        $pro2->name = 'HDMI Cable';
        $pro2->description = '3 Meters cable';
        $pro2->price = 35.00;
        $pro2->supplier_id = $sup3->id;
        $pro2->save();
        $pro2->categories()->sync([$cat1->id, $cat3->id, $cat4->id]);

        $pro3 = new Product;
        $pro3->name = 'Water Jog';
        $pro3->description = 'Can contain 2 liters of liquid';
        $pro3->price = 30.00;
        $pro3->supplier_id = $sup4->id;
        $pro3->save();
        $pro3->categories()->sync($cat2->id);
    }
}
