<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 100; $i++) {

            DB::table('posts')->insert([
                'title' => $faker->text(25),
                'image_products' => 'https://vnexpress.net/gdp-quy-ii-tang-6-93-4764068.html#vn_source=Home&vn_campaign=ThuongVien&vn_medium=Item-1&vn_term=Desktop&vn_thumb=1&vn_aid=1000000',
                'description' => $faker->text('50'),
                'content' => $faker->text(),
                'view' => rand(1, 1000),
                'cate_id' => rand(1, 4)
            ]);
        }

    }
}
