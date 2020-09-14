<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class WhereLikeScope extends ScopeAbstract
{
    /**
     * Where like scope.
     *
     * @param \CodeIgniter\Database\BaseBuilder $builder
     * @param string                            $value
     * @param string                            $scope
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function scope($builder, $value, $scope)
    {
        return $builder->like($scope, $value);
    }
}
