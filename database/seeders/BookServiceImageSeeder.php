<?php

namespace Database\Seeders;

use App\Models\BookServiceImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookServiceImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $bookServiceIds = DB::table('book_services')->pluck('id');  // Получаем все book_service_id

        // Путь к папке для загрузки изображений
        $uploadDir = public_path('uploads/service');

        // Убедимся, что папка существует
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);  // Создаём директорию, если её нет
        }

        for ($i = 0; $i < 25; $i++) {
            // Генерация случайного изображения с помощью Faker
            $imagePath = $faker->image($uploadDir, 640, 480, null, false);

            // Проверка, что путь к изображению не пустой
            if (empty($imagePath)) {
                continue;  // Пропустить итерацию, если путь пустой
            }

            // Генерация случайного имени для файла
            $randomStr = Str::random(30);
            $filename = $randomStr . '.jpg';

            // Путь для сохранения файла
            $filePath = 'uploads/service/' . $filename;

            // Проверка, что изображение существует перед копированием
            if (file_exists($imagePath)) {
                // Копируем изображение в папку public/uploads/service
                copy($imagePath, public_path($filePath));  // Копируем изображение в нужную директорию
            } else {
                // Если изображение не существует, пропускаем итерацию
                continue;
            }

            // Добавляем запись в таблицу
            BookServiceImage::create([
                'book_service_id' => $faker->randomElement($bookServiceIds),  // Ссылаемся на случайный book_service_id
                'attachment_image' => $filePath, // Путь к изображению
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
