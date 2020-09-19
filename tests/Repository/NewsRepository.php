<?php

namespace Fluent\Repository\Tests\Repository;

use Fluent\Repository\Eloquent\BaseRepository;
use Fluent\Repository\Tests\Models\NewsModel;

class NewsRepository extends BaseRepository
{
    protected $searchable = [
        'id' => 'or',
        'title' => 'like',
        'description' => 'orLike',
    ];

    public function entity()
    {
        return NewsModel::class;
    }
}
