<?php

namespace Fluent\Repository\Contracts;

interface CriterionInterface
{
    public function apply($entity);
}