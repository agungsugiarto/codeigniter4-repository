<?php

namespace Fluent\Repository\Contracts;

interface CriterionInterface
{
    /**
     * Apply model entity.
     *
     * @param \CodeIgniter\Model $entity
     * @return mixed
     */
    public function apply($entity);
}