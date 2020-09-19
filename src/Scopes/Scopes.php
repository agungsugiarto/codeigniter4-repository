<?php

namespace Fluent\Repository\Scopes;

use CodeIgniter\HTTP\IncomingRequest;
use Fluent\Repository\Scopes\Clauses\WhereScope;
use Fluent\Repository\Scopes\Clauses\OrderByScope;
use Fluent\Repository\Scopes\Clauses\OrWhereScope;
use Fluent\Repository\Scopes\Clauses\WhereLikeScope;
use Fluent\Repository\Scopes\Clauses\OrWhereLikeScope;
use Fluent\Repository\Scopes\Clauses\WhereDateLessScope;
use Fluent\Repository\Scopes\Clauses\WhereDateGreaterScope;

class Scopes extends ScopesAbstract
{
    /** @var array $scopes */
    protected $scopes = [
        'orderBy' => OrderByScope::class,
        'begin' => WhereDateGreaterScope::class,
        'end' => WhereDateLessScope::class,
    ];
    
    /**
     * Constructor scopes.
     *
     * @param  \CodeIgniter\HTTP\IncomingRequest $request
     * @param  array                             $searchable
     * @return void
     */
    public function __construct(IncomingRequest $request, $searchable)
    {
        parent::__construct($request);

        foreach ($searchable as $key => $value) {
            if (is_string($key)) {
                $this->scopes[$key] = $this->mappings($value);
            } else {
                $this->scopes[$value] = WhereScope::class;
            }
        }
    }
    
    /**
     * Mapping by scope.
     *
     * @param  string $key
     * @return string
     */
    protected function mappings(string $key)
    {
        $mappings = [
            'or' => OrWhereScope::class,
            'like' => WhereLikeScope::class,
            'orLike' => OrWhereLikeScope::class,
        ];

        return $mappings[$key] ?? WhereScope::class;
    }
}
