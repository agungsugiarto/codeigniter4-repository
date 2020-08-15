<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class OrWhereLikeScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->orLike($scope, $value);
    }
}