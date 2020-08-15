<?php

namespace Fluent\Repository\Scopes\Clauses;

use Fluent\Repository\Scopes\ScopeAbstract;

class WhereDateLessScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->orWhere('created_at', '<', $value);
    }
}