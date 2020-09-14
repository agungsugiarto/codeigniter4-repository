<?php

namespace Fluent\Repository\Eloquent;

use Fluent\Repository\Scopes\Scopes;
use Fluent\Repository\Contracts\ScopesInterface;
use Fluent\Repository\Contracts\CriteriaInterface;
use Fluent\Repository\Exceptions\RepositoryException;

abstract class RepositoryAbstract implements CriteriaInterface, ScopesInterface
{
    /** @var \CodeIgniter\Model $entity */
    protected $entity;

    /** @var array $searchable */
    protected $searchable = [];

    /**
     * Constructor Repository abstract.
     */
    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * Abstact method to difine instance model.
     *
     * @return \CodeIgniter\Model;
     */
    abstract public function entity();

    /**
     * @inheritdoc
     */
    public function withCriteria(array $criteria)
    {
        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }
        
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function scope($request)
    {
        $this->entity = (new Scopes($request, $this->searchable))->scope($this->entity);

        return $this;
    }

    /**
     * Reset model to new instance.
     *
     * @return void
     */
    public function reset()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * Provides direct access to method in the builder (if available)
     * and the database connection.
     *
     * @return $this
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->entity, 'scope' . ucfirst($method))) {
            $this->entity = $this->entity->{$method}(...$parameters);
            
            return $this;
        }
        
        $this->entity = call_user_func_array([$this->entity, $method], $parameters);

        return $this;
    }

    /**
     * Provides/instantiates the from entity model.
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->entity->{$name};
    }

    /**
     * Resolve entity.
     *
     * @return \CodeIgniter\Model
     *
     * @throws RepositoryException
     */
    protected function resolveEntity()
    {
        $entity = $this->entity();

        if (is_string($entity)) {
            return new $entity();
        } elseif ($entity instanceof \CodeIgniter\Model) {
            return $entity;
        }

        throw new RepositoryException(
            "Class {$entity} must be an instance of CodeIgniter\\Model"
        );
    }
}
