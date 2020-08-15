<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class OrWhereScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->orWhere($scope, $value);
    }
}