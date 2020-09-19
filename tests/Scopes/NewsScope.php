<?php

namespace Fluent\Repository\Tests\Scopes;

use Fluent\Repository\Scopes\ScopesAbstract;
use Fluent\Repository\Tests\Scopes\Clauses\MyScope;

class NewsScope extends ScopesAbstract
{
    protected $scopes = [
        'id' => MyScope::class
    ];
}
