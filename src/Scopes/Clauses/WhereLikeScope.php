<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class WhereLikeScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->like($scope, $value);
    }
}