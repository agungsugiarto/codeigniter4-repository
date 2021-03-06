<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class OrWhereLikeScope extends ScopeAbstract
{
    /**
     * Or where like scope.
     *
     * @param \CodeIgniter\Database\BaseBuilder $builder
     * @param string                            $value
     * @param string                            $scope
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function scope($builder, $value, $scope)
    {
        return $builder->orLike($scope, $value);
    }
}
