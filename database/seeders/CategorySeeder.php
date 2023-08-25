<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category_name' => 'Alam'
            ],
            [
                'category_name' => 'Lingkungan'
            ],
            [
                'category_name' => 'Cinta'
            ],
            [
                'category_name' => 'Motivasi'
            ],
            [
                'category_name' => 'Filsafat'
            ],
            [
                'category_name' => 'Pendidikan'
            ],
            [
                'category_name' => 'Sosial'
            ],
            [
                'category_name' => 'Masyarakat'
            ],
            [
                'category_name' => 'Budaya'
            ],
            [
                'category_name' => 'Teknologi'
            ],
            [
                'category_name' => 'Hak Asasi'
            ],
            [
                'category_name' => 'Dunia'
            ],
            [
                'category_name' => 'Spiritual'
            ],
            [
                'category_name' => 'Agama'
            ],
            [
                'category_name' => 'Hidup'
            ],
            [
                'category_name' => 'Tujuan'
            ],
            [
                'category_name' => 'Keberanian'
            ],
            [
                'category_name' => 'Pengalaman'
            ],
            [
                'category_name' => 'Kemanusiaan'
            ],
            [
                'category_name' => 'Hewan'
            ],
            [
                'category_name' => 'Puisi'
            ],
            [
                'category_name' => 'Artikel'
            ],
            [
                'category_name' => 'Refleksi'
            ],
            [
                'category_name' => 'Kenangan'
            ],
        ];

        foreach ($data as $category) {
            Category::create($category);
        };
    }
}
