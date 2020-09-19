<?php

namespace Fluent\Repository\Criteria;

use CodeIgniter\Model;
use Fluent\Repository\Contracts\CriterionInterface;

class FindWhere implements CriterionInterface
{
    /** @var array $conditions */
    protected $conditions;
    
    /**
     * Constructor FindWhare.
     *
     * @param array $conditions
     * @return void
     */
    public function __construct(array $conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * @inheritdoc
     */
    public function apply(Model $entity)
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
