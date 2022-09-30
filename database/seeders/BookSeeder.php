<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::truncate();

        $csvFile = fopen(base_path("database/data/books.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Book::create([
                    'name' => $data['0'],
                    'level' => $data['1'],
                    'section' => $data['2'],
                    'type' => $data ['3'],
                    'link' => $data['4'],
                    'pages' => $data['5']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
