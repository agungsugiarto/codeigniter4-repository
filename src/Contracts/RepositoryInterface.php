<?php

namespace Fluent\Repository\Contracts;

interface RepositoryInterface
{
    /**
     * Execute the query as a "select" statement.
     *
     * @param array $columns
     * @return array
     */
    public function get(array $columns = ['*']);

    /**
     * Execute the query and get the first result.
     *
     * @param array $columns
     * @return array
     */
    public function first($columns = ['*']);

    /**
     * Find a model by its primary key.
     *
     * @param mixed $id
     * @param array $columns
     * @return array|object
     */
    public function find($id, $columns = ['*']);

    /**
     * Add basic where clauses and execute the query.
     *
     * @param array $conditions
     * @param array $columns
     * @return array
     */
    public function findWhere(array $conditions, array $columns = ['*']);

    /**
     * Paginate the given query.
     *
     * @param int   $perPage
     * @param array $columns
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function paginate($perPage = null, $columns = ['*']);

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     * @return \CodeIgniter\Database\BaseResult|false|int|string
     * 
     * @throws \ReflectionException
     */
    public function create(array $attributes);

    /**
     * Update a record.
     *
     * @param array $values
     * @param int   $id
     * @return int
     * 
     * @throws \ReflectionException
     */
    public function update(array $values, $id);

    /**
     * Delete a record by id.
     * 
     * @param int $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Add an "order by" clause to the query.
     *
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc');
}
