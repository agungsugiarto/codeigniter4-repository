<?php

namespace Fluent\Repository\Tests;

use CodeIgniter\Config\Services;
use CodeIgniter\I18n\Time;
use CodeIgniter\Test\CIDatabaseTestCase;
use CodeIgniter\Test\ControllerTester;
use Fluent\Repository\Tests\Repository\NewsRepositoryScope;
use Tests\Support\Database\Seeds\NewsSeeder;

class NewsRepositoryRequestTest extends CIDatabaseTestCase
{
    protected $refresh = false;

    protected $seed = NewsSeeder::class;
    
    /** @var NewsRepositoryScope */
    protected $repository;

    /** @var \CodeIgniter\HTTP\IncomingRequest */
    protected $request;
    
    protected function setUp(): void
    {
        parent::setUp();

        /** @var NewsRepositoryScope */
        $this->repository = new NewsRepositoryScope();

        $this->request = Services::request();
    }

    public function testRepositoryMyCustomScope()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'id' => '1',
            ]);

        $this->assertNotEmpty($this->repository->scope(Services::request())->first());
    }

    public function testRepositoryMyCustomScopeIsNull()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'id' => '1000',
            ]);

        $this->assertNull($this->repository->scope(Services::request())->first());
    }

    public function testRepositoryScopeTitle()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'title' => 'A',
            ]);

        $this->assertNotEmpty($this->repository->scope(Services::request())->first());
    }

    public function testRepositoryScopeTitleIsNull()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'title' => 'Aaaaaa',
            ]);

        $this->assertNull($this->repository->scope(Services::request())->first());
    }

    public function testRepositoryScopeDescription()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'description' => 'A',
            ]);

        $this->assertNotEmpty($this->repository->scope(Services::request())->first());
    }

    public function testRepositoryScopeDescriptionIsNull()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'description' => 'Aaaaaa',
            ]);

        $this->assertNull($this->repository->scope(Services::request())->first());
    }

    public function testRepositoryScopeRequestOrderByAsc()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'orderBy' => 'title_asc',
            ]);

        $this->assertNotEmpty($this->repository->scope(Services::request())->paginate());
    }

    public function testRepositoryScopeRequestOrderByDesc()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'orderBy' => 'title_desc',
            ]);

        $this->assertNotEmpty($this->repository->scope(Services::request())->paginate());
    }

    public function testRepositoryScopeRequestBeginEnd()
    {
        $this->request->setMethod('get')
            ->setGlobal('get', [
                'begin' => Time::now(),
                'end'   => Time::now(),
            ]);

        $this->assertNotNull($this->repository->scope(Services::request())->paginate());
    }
}
