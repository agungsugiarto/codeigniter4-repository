<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class OrWhereLikeScope extends ScopeAbstract
{
    /**
     * Or where like scope.
     *
     * @param \CodeIgniter\Model $builder
     * @param                    $value
     * @param                    $scope
     * @return mixed
     */
    public function scope($builder, $value, $scope)
    {
        return $builder->orLike($scope, $value);
    }
}