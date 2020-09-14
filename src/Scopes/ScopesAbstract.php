<?php

namespace Fluent\Repository\Scopes;

class ScopesAbstract
{
    /** @var \CodeIgniter\HTTP\IncomingRequest $request */
    protected $request;

    /** @var array $scopes */
    protected $scopes = [];

    /**
     * ScopesAbstract constructor.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * In your repository define which fields can be used to scope your queries.
     *
     * @param \CodeIgniter\Database\BaseBuilder $builder
     * @return \CodeIgniter\Database\BaseBuilder $builder
     */
    public function scope($builder)
    {
        $scopes = $this->getScopes();

        foreach ($scopes as $scope => $value) {
            $builder = $this->resolveScope($scope)->scope($builder, $value, $scope);
        }

        return $builder;
    }

    /**
     * Resolve scope mapping.
     *
     * @param string $scope
     * @return object
     */
    protected function resolveScope($scope)
    {
        return new $this->scopes[$scope]();
    }
    
    /**
     * Get scope mapping by request.
     *
     * @return object
     */
    protected function getScopes()
    {
        return $this->filterScopes(
            $this->request->getVar(array_keys($this->scopes))
        );
    }

    /**
     * Filter scopes.
     *
     * @param array $scopes
     * @return array
     */
    protected function filterScopes($scopes)
    {
        return array_filter($scopes, function ($scope) {
            return isset($scope);
        });
    }
}
