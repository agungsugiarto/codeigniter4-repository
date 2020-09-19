<?php

namespace Fluent\Repository\Tests\Repository;

use CodeIgniter\HTTP\IncomingRequest;
use Fluent\Repository\Eloquent\BaseRepository;
use Fluent\Repository\Tests\Models\NewsModel;
use Fluent\Repository\Tests\Scopes\NewsScope;

class NewsRepositoryScope extends BaseRepository
{
    protected $searchable = [
        'title' => 'like',
        'description' => 'orLike',
    ];

    public function scope(IncomingRequest $request)
    {
        parent::scope($request);

        $this->entity = (new NewsScope($request))->scope($this->entity);

        return $this->entity;
    }

    public function entity()
    {
        return NewsModel::class;
    }
}