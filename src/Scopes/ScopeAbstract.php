<?php

namespace Fluent\Repository\Scopes;

abstract class ScopeAbstract
{
    /**
     * In your repository define which fields can be used to scope your queries.
     *
     * @param \CodeIgniter\Database\BaseBuilder $builder
     * @return \CodeIgniter\Database\BaseBuilder $builder
     */
    abstract public function scope($builder, $value, $scope);

    /**
     * Override mappings key.
     *
     * @return array
     */
    public function mappings()
    {
        return [];
    }

    protected function resolveScopeValue($key)
    {
        return array_get($this->mappings(), $key);
    }
}
