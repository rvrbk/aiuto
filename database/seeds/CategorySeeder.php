<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Help;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'I need someone to do my groceries', 'code' => 'GROCERIES'],
            ['name' => 'I want to have some social contact', 'code' => 'SOCIAL'],
            ['name' => 'I need someone to provide some medical care', 'code' => 'MEDICAL'],
            ['name' => 'I need help doing erands like walking the dog', 'code' => 'DOG'],
            ['name' => 'I need some other kind of help', 'code' => 'OTHER']
        ];

        foreach($categories as $category) {
            if(!Category::where('code', $category['code'])->first()) {
                $c = new Category();

                $c->name = $category['name'];
                $c->code = $category['code'];

                $c->save();
            }
        }

        $help = Help::whereNull('category')
            ->get();

        $other = Category::where('code', 'OTHER')
            ->first();

        foreach($help as $h) {
            $h->category = $other->id;

            $h->save();
        }
    }
}
