<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Fluent\Repository\Tests\Models\NewsModel;

if (! function_exists('factory')) {
    /**
     * Create a factory seeder.
     *
     * @param Model|object|string $model      Instance or name of the model
     * @param int|null            $count      Create factory
     * @param array|null          $formatters Difine faker factory
     * @param array|null          $overrides  Overriding data to pass to Fabricator::setOverrides()
     * @return object|array
     */
    function factory($model, $count = null, ?array $formatters = null, ?array $overrides = null)
    {
        $fabricator = new \CodeIgniter\Test\Fabricator($model, $formatters);

        if (! is_null($overrides)) {
            $fabricator->setOverrides($overrides);
        }

        return $fabricator->create($count);
    }
}

class NewsSeeder extends Seeder
{
    public function run()
    {
        factory(NewsModel::class, 10);
    }
}
