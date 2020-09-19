<?php

namespace Fluent\Repository\Tests;

use CodeIgniter\Test\CIDatabaseTestCase;
use Fluent\Repository\Tests\Criteria\SampleCriteria;
use Fluent\Repository\Tests\Repository\NewsRepository;
use Tests\Support\Database\Seeds\NewsSeeder;

class NewsRepositoryTest extends CIDatabaseTestCase
{
    protected $refresh = true;

    protected $seed = NewsSeeder::class;
    
    /** @var NewsRepository */
    protected $repository;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new NewsRepository();
    }

    public function testRepositoryGet()
    {
        $this->assertNotEmpty($this->repository->get());
    }

    public function testRepositoryFirst()
    {
        $this->assertNotEmpty($this->repository->first());
    }

    public function testRepositoryFind()
    {
        $this->assertNotEmpty($this->repository->find(1));
    }

    public function testRepositoryFindWhere()
    {
        $this->assertNotEmpty(
            $this->repository->findWhere(['id' => 1])->get()
        );
    }

    public function testRepositoryWithCriteria()
    {
        $this->assertNotEmpty(
            $this->repository->withCriteria([
                new SampleCriteria([
                    'id' => 1,
                    ['id', '=', 2]
                ]),
            ])
            ->get()
        );
    }

    public function testRepositoryPaginate()
    {
        $this->assertNotEmpty($this->repository->paginate());
    }
    
    public function testRepositoryCreate()
    {
        $this->assertIsInt($this->repository->create([
            'title' => 'Sample title',
            'description' => 'Sample Description'
        ]));
    }

    public function testRepositoryCreateBatch()
    {
        $data = [
            [
                'title' => 'My title',
                'description' => 'My Name',
            ],
            [
                'title' => 'Another title',
                'description' => 'Another Name',
            ]
        ];

        $this->assertIsInt($this->repository->createBatch($data));
    }

    public function testRepositoryUpdate()
    {
        $this->assertTrue($this->repository->update([
            'title' => 'Sample title',
            'description' => 'Sample Description'
        ], 1));
    }

    public function testRepositoryUpdateBatch()
    {
        $data = [
            [
                'title' => 'My title',
                'description' => 'My Name',
            ],
            [
                'title' => 'Another title',
                'description' => 'Another Name',
            ]
        ];

        $this->assertIsInt($this->repository->updateBatch($data, 'title'));
    }

    public function testRepositoryDestory()
    {
        $this->assertIsObject($this->repository->destroy(1));
    }

    public function testRepositoryOrderBy()
    {
        $this->assertNotEmpty($this->repository->orderBy('title', 'desc')->get());
    }
}
