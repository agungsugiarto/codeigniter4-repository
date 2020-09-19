<?php

namespace Fluent\Repository\Tests\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description'];
    protected $useTimestamps = true;

    public $orderable = ['title'];

    /**
     * Faker generator.
     * 
     * @param \Faker\Generator $faker
     * @return array|object
     */
    public function fake($faker)
    {
        return [
            'title' => $faker->name,
            'description' => $faker->text,
        ];
    }
}