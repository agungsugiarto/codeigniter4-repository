<?php

namespace Fluent\Repository\Criteria;

use Fluent\Repository\Contracts\CriterionInterface;

class FindWhere implements CriterionInterface
{
    protected $conditions;
    
    public function __construct(array $conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * Apply model entity.
     *
     * @param \CodeIgniter\Model $entity
     * @return mixed
     */
    public function apply($entity)
    {
        foreach ($this->conditions as $field => $value) {

            if (is_array($value)) {

                list($field, $condition, $val) = $value;

                $entity = $entity->orWhere($field . $condition, $val);

            } else {

                $entity = $entity->where($field, $value);
            }
        }
        
        return $entity;
    }
}