<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices, gadgets, and accessories'],
            ['name' => 'Furniture', 'description' => 'Home and office furniture'],
            ['name' => 'Books', 'description' => 'Books across various genres'],
            ['name' => 'Clothing', 'description' => 'Apparel and fashion items'],
            ['name' => 'Sports', 'description' => 'Sports equipment and accessories'],
            ['name' => 'Toys', 'description' => 'Toys and games for children'],
            ['name' => 'Health & Beauty', 'description' => 'Cosmetics, skincare, and health products'],
            ['name' => 'Automotive', 'description' => 'Car parts, accessories, and tools'],
            ['name' => 'Jewelry', 'description' => 'Rings, necklaces, and other fine jewelry'],
            ['name' => 'Groceries', 'description' => 'Food items and kitchen essentials'],
            ['name' => 'Home Appliances', 'description' => 'Appliances for kitchen and household use'],
            ['name' => 'Music', 'description' => 'Musical instruments, equipment, and accessories'],
            ['name' => 'Garden', 'description' => 'Outdoor furniture, plants, and garden tools'],
            ['name' => 'Office Supplies', 'description' => 'Stationery and office equipment'],
            ['name' => 'Pet Supplies', 'description' => 'Products for pets like food, toys, and accessories'],
        ];


        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
