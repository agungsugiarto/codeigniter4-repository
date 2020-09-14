<?php

namespace Fluent\Repository\Contracts;

interface CriteriaInterface
{
    /**
     * Criteria are a way to build up specific query conditions.
     *
     * @param array $criteria
     * @return $this
     */
    public function withCriteria(array $criteria);
}
