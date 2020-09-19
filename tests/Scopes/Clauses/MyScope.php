<?php

namespace Fluent\Repository\Tests\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class MyScope extends ScopeAbstract
{
    /**
     * @inheritdoc
     */
    public function scope($builder, $value, $scope)
    {
        return $builder->where($scope, $value);
    }
}