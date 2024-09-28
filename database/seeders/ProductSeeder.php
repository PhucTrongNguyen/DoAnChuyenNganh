<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['proc_id' => 'P0001', 'cate_id' => 'C0001', 'name' => 'Aviator Sunglasses', 'price' => 100, 'quantity' => 50, 'picture' => 'aviator.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0002', 'cate_id' => 'C0002', 'name' => 'Rectangular Prescription Glasses', 'price' => 80, 'quantity' => 40, 'picture' => 'rectangular.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0003', 'cate_id' => 'C0003', 'name' => 'Classic Reading Glasses', 'price' => 150, 'quantity' => 30, 'picture' => 'reading.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0004', 'cate_id' => 'C0004', 'name' => 'Safety Goggles', 'price' => 60, 'quantity' => 25, 'picture' => 'safety.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0005', 'cate_id' => 'C0005', 'name' => 'Sports Sunglasses', 'price' => 70, 'quantity' => 60, 'picture' => 'sports.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0006', 'cate_id' => 'C0006', 'name' => 'Blue Light Blocking Glasses', 'price' => 90, 'quantity' => 45, 'picture' => 'bluelight.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0007', 'cate_id' => 'C0007', 'name' => 'Fashion Cat Eye Glasses', 'price' => 110, 'quantity' => 55, 'picture' => 'cateye.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0008', 'cate_id' => 'C0008', 'name' => 'Kids Colorful Glasses', 'price' => 130, 'quantity' => 20, 'picture' => 'kids.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0009', 'cate_id' => 'C0009', 'name' => 'Daily Contact Lenses', 'price' => 200, 'quantity' => 80, 'picture' => 'contact.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
            ['proc_id' => 'P0010', 'cate_id' => 'C0010', 'name' => 'Eyewear Accessories', 'price' => 300, 'quantity' => 10, 'picture' => 'accessories.jpg', 'created_at' => '2024-09-27 10:28:02', 'updated_at' => '2024-09-27 10:28:02'],
        ]);
    }
}
