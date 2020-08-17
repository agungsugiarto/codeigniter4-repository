<?php

namespace Fluent\Repository\Eloquent;

use Fluent\Repository\Contracts\RepositoryInterface;
use Fluent\Repository\Criteria\FindWhere;

abstract class BaseRepository extends RepositoryAbstract implements RepositoryInterface
{    
    /**
     * Execute the query as a "select" statement.
     *
     * @param array $columns
     * @return array
     */
    public function get(array $columns = ['*'])
    {
        $results = $this->entity->select($columns)->findAll();

        $this->reset();

        return $results;
    }

    /**
     * Execute the query and get the first result.
     *
     * @param array $columns
     * @return array|object
     */
    public function first($columns = ['*'])
    {
        $results = $this->entity->select($columns)->first();

        $this->reset();

        return $results;
    }

    /**
     * Find a model by its primary key.
     *
     * @param mixed $id
     * @param array $columns
     * @return array|object
     */
    public function find($id, $columns = ['*'])
    {
        $results = $this->entity->select($columns)->find($id);

        $this->reset();

        return $results;
    }

    /**
     * Add basic where clauses and execute the query.
     *
     * @param array $conditions
     * @param array $columns
     * @return array
     */
    public function findWhere(array $conditions, array $columns = ['*'])
    {
        return $this->withCriteria([
            new FindWhere($conditions)
        ])->get($columns);
    }

    /**
     * Paginate the given query.
     *
     * @param int   $perPage
     * @param array $columns
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function paginate($perPage = null, $columns = ['*'])
    {
        return [
            'data'     => $this->entity->select($columns)->paginate($perPage),
            'paginate' => $this->entity->pager,
        ];
    }

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     * @return \CodeIgniter\Database\BaseResult|false|int|string
     * @throws \ReflectionException
     */
    public function create(array $attributes)
    {
        $results = $this->entity->insert($attributes);

        $this->reset();

        return $results;
    }

    /**
     * Update a record.
     *
     * @param array $values
     * @param int   $id
     * @return int
     * @throws \ReflectionException
     */
    public function update(array $values, $id)
    {
        $results = $this->entity->update($id, $values);

        $this->reset();

        return $results;
    }

    /**
     * Delete a record by id.
     * 
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $results = $this->entity->delete($id);

        $this->reset();

        return $results;
    }

    /**
     * Add an "order by" clause to the query.
     *
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->entity = $this->entity->orderBy($column, $direction);

        return $this;
    }
}