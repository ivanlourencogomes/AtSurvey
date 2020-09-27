<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerFields extends Model
{
    /* 
        Setup the json field for options: https://stackoverflow.com/questions/32954424/laravel-migration-array-type-store-array-in-database-column
    
        Use Eloquent's available workaround by using attribute casting. In your migration create the column as json like so:

        public function up()
        {
            Schema::create('pickups', function (Blueprint $table) {
                $table->increment('id');
                $table->boolean('default');
                $table->json('shifts');
                $table->integer('status_id');

                $table->timestamps();
            });
        }
        Then you can setup your Pickup model (if you haven't done so already) and use the $casts property:

        class Pickup extends Model
        {
            protected $casts = [
                'shifts' => 'array'
            ];
        }
        This will let Eloquent know that when it fetches data from the database it will have to convert the shifts column value to an array. This is only emulating an actual array, as at the database level the column is of type TEXT and the array is serialized. However when unserializing the column value, Eloquent returns an actual array of integers for you to use in your code. Below is an example use case:

        // Create a new Pickup entry
        $pickup = App\Pickup::create([
            'default' => true,
            'shifts' => '[1, 5, 7]', // you can easily assign an actual integer array here
            'status_id' => 1
        ]);
        Assuming the above generated an entry with id equal to 1 when you later retrieve the entry:

        $pickup = App\Pickup::find(1);
        dump($pickup->shifts);
        The dump() from the code above will output an actual array of integers:

        array:3 [▼
        0 => 1
        1 => 5
        2 => 7
        ] */
}
