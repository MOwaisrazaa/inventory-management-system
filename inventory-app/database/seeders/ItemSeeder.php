<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Samsung Galaxy S23',
                'sku' => 'ITEM-0001',
                'description' => 'Latest Samsung flagship smartphone',
                'purchase_price' => 85000.00,
                'selling_price' => 95000.00,
                'quantity' => 15,
                'unit' => 'pcs',
            ],
            [
                'name' => 'iPhone 14 Pro',
                'sku' => 'ITEM-0002',
                'description' => 'Apple iPhone 14 Pro 256GB',
                'purchase_price' => 120000.00,
                'selling_price' => 135000.00,
                'quantity' => 10,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Dell Laptop Inspiron',
                'sku' => 'ITEM-0003',
                'description' => 'Dell Inspiron 15 i5 8GB RAM',
                'purchase_price' => 65000.00,
                'selling_price' => 75000.00,
                'quantity' => 8,
                'unit' => 'pcs',
            ],
            [
                'name' => 'HP Printer LaserJet',
                'sku' => 'ITEM-0004',
                'description' => 'HP LaserJet Pro Printer',
                'purchase_price' => 18000.00,
                'selling_price' => 22000.00,
                'quantity' => 20,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Logitech Wireless Mouse',
                'sku' => 'ITEM-0005',
                'description' => 'Logitech M185 Wireless Mouse',
                'purchase_price' => 800.00,
                'selling_price' => 1200.00,
                'quantity' => 50,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Sony Headphones WH-1000XM4',
                'sku' => 'ITEM-0006',
                'description' => 'Sony Noise Cancelling Headphones',
                'purchase_price' => 28000.00,
                'selling_price' => 32000.00,
                'quantity' => 12,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Samsung 55" LED TV',
                'sku' => 'ITEM-0007',
                'description' => 'Samsung 55 inch 4K Smart LED TV',
                'purchase_price' => 75000.00,
                'selling_price' => 85000.00,
                'quantity' => 5,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Canon DSLR Camera',
                'sku' => 'ITEM-0008',
                'description' => 'Canon EOS 200D DSLR Camera',
                'purchase_price' => 45000.00,
                'selling_price' => 52000.00,
                'quantity' => 6,
                'unit' => 'pcs',
            ],
            [
                'name' => 'JBL Bluetooth Speaker',
                'sku' => 'ITEM-0009',
                'description' => 'JBL Flip 5 Portable Speaker',
                'purchase_price' => 8500.00,
                'selling_price' => 11000.00,
                'quantity' => 25,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Apple Watch Series 8',
                'sku' => 'ITEM-0010',
                'description' => 'Apple Watch Series 8 GPS 45mm',
                'purchase_price' => 42000.00,
                'selling_price' => 48000.00,
                'quantity' => 7,
                'unit' => 'pcs',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
