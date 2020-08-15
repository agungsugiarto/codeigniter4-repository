<?php

namespace Fluent\Repository\Eloquent;

use Fluent\Repository\Contracts\RepositoryInterface;
use Fluent\Repository\Criteria\FindWhere;

abstract class BaseRepository extends RepositoryAbstract implements RepositoryInterface
{    
    /**
     * Execute the query as a "select" statement.
     *
     * @return \CodeIgniter\Model
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
     * @param  array  $columns
     * @return \CodeIgniter\Model
     */
    public function first($columns = ['*'])
    {
        $results = $this->entity->select($columns)->first($columns);

        $this->reset();

        return $results;
    }

    /**
     * Find a model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \CodeIgniter\Model
     */
    public function find($id, $columns = ['*'])
    {
        $results = $this->entity->find($id, $columns);

        $this->reset();

        return $results;
    }

    /**
     * Add basic where clauses and execute the query.
     *
     * @param array $conditions
     * @param array $columns
     *
     * @return \CodeIgniter\Model
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
     * @param  int  $perPage
     * @param  array  $columns
     * @return \CodeIgniter\Model
     *
     * @throws \InvalidArgumentException
     */
    public function paginate($perPage = null, $columns = ['*'])
    {
        $results = $this->entity->select($columns)->paginate($perPage);

        $this->reset();

        return $results;
    }

     /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        $results = $this->entity->create($attributes);

        $this->reset();

        return $results;
    }

    /**
     * Update a record.
     *
     * @param  array  $values
     * @param  int  $id
     * 
     * @return int
     */
    public function update(array $values, $id, $attribute = "id")
    {
        $model = $this->entity->where($attribute, $id)->firstOrFail();

        $results = $model->update($values);

        $this->reset();

        return $results;
    }

    /**
     * Delete a record by id.
     * 
     * @param  int  $id
     * 
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
     * @param  string  $column
     * @param  string  $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->entity = $this->entity->orderBy($column, $direction);

        return $this;
    }
}