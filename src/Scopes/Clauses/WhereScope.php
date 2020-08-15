<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class WhereScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->where($scope, $value);
    }
}