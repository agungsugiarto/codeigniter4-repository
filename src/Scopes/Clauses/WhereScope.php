<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class WhereScope extends ScopeAbstract
{
    /**
     * Where scope.
     *
     * @param \CodeIgniter\Model $builder
     * @param                    $value
     * @param                    $scope
     * @return mixed
     */
    public function scope($builder, $value, $scope)
    {
        return $builder->where($scope, $value);
    }
}