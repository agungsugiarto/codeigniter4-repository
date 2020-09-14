<?php

namespace Fluent\Repository\Contracts;

interface ScopesInterface
{
    /**
     * In your repository define which fields can be used to scope your queries.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request
     * @return $this
     */
    public function scope($request);
}
