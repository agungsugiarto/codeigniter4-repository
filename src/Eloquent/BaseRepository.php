<?php

namespace Fluent\Repository\Eloquent;

use Fluent\Repository\Contracts\RepositoryInterface;
use Fluent\Repository\Criteria\FindWhere;

abstract class BaseRepository extends RepositoryAbstract implements RepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function get(array $columns = ['*'])
    {
        $results = $this->entity->select($columns)->findAll();

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function first($columns = ['*'])
    {
        $results = $this->entity->select($columns)->first();

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function find($id, $columns = ['*'])
    {
        $results = $this->entity->select($columns)->find($id);

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function findWhere(array $conditions)
    {
        $this->withCriteria([
            new FindWhere($conditions)
        ]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function paginate($perPage = null, $columns = ['*'])
    {
        $results = [
            'data'     => $this->entity->select($columns)->paginate($perPage),
            'paginate' => $this->entity->pager,
        ];

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes)
    {
        $results = $this->entity->insert($attributes);

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function createBatch(array $attributes)
    {
        $results = $this->entity->insertBatch($attributes);

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function update(array $values, $id)
    {
        $results = $this->entity->update($id, $values);

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function updateBatch(array $attributes, $id)
    {
        $results = $this->entity->updateBatch($attributes, $id);

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function destroy($id)
    {
        $results = $this->entity->delete($id);

        $this->reset();

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->entity = $this->entity->orderBy($column, $direction);

        return $this;
    }
}
