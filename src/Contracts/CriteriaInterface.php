<?php

namespace Fluent\Repository\Contracts;

interface CriteriaInterface
{
    public function withCriteria(array $criteria);
}