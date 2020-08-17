<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class WhereDateLessScope extends ScopeAbstract
{
    /**
     * Where date less scope.
     *
     * @param \CodeIgniter\Model $builder
     * @param                    $value
     * @param                    $scope
     * @return mixed
     */
    public function scope($builder, $value, $scope)
    {
        return $builder->orWhere('created_at' . '<', $value);
    }
}