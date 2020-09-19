<?php

namespace Fluent\Repository\Contracts;

use CodeIgniter\Model;

interface CriterionInterface
{
    /**
     * Apply model entity.
     *
     * @param \CodeIgniter\Model $entity
     * @return mixed
     */
    public function apply(Model $entity);
}
