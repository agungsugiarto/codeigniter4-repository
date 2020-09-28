<?php

namespace Fluent\Repository\Contracts;

interface RepositoryInterface
{
    /**
     * Execute the query as a "select" statement.
     *
     * @param array $columns
     * @param int   $limit
     * @param int   $offset
     * @return array
     */
    public function get(array $columns = ['*'], int $limit = 0, int $offset = 0);

    /**
     * Execute the query and get the first result.
     *
     * @param array $columns
     * @return array|object
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
     * @return $this
     */
    public function findWhere(array $conditions);

    /**
     * Paginate the given query.
     *
     * @param int|null $perPage
     * @param array    $columns
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
     * Save a batch new model and return instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function createBatch(array $attributes);

    /**
     * Update a record.
     *
     * @param array|object     $values
     * @param array|int|string $id
     * @return bool
     *
     * @throws \ReflectionException
     */
    public function update(array $values, $id);

    /**
     * Update a batch record.
     *
     * @param array  $attributes
     * @param string $id
     * @return mixed
     *
     * @throws \CodeIgniter\Database\Exceptions\DatabaseException
     */
    public function updateBatch(array $attributes, $id);

    /**
     * Delete a record by id.
     *
     * @param mixed $id
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
