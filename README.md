# CodeIgniter4 Repository Pattern
>Implementation of repository pattern for CodeIgniter 4. The package allows out-of-the-box filtering of data based on parameters in the <b>request</b>, and also allows you to quickly integrate the list filters and custom criteria.

## Table of Contents

- <a href="#installation">Installation</a>
- <a href="#configuration">Configuration</a>
- <a href="#overview">Overview</a>
- <a href="#usage">Usage</a>
    - <a href="#create-a-model">Create a Model</a>
    - <a href="#create-a-repository">Create a Repository</a>
    - <a href="#use-built-in-methods">Use built-in methods</a>
    - <a href="#create-a-criteria">Create a Criteria</a>
    - <a href="#scope-filter-and-order">Scope, Filter, and Order</a>

## Installation

Via Composer

``` bash
$ composer require agungsugiarto/codeigniter4-repository
```

## Overview


##### Package allows you to filter data based on incoming request parameters:

```
https://example.com/news?title=Title&custom=value&orderBy=name_desc
```

It will automatically apply built-in constraints onto the query as well as any custom scopes and criteria you need:

```php
protected $searchable = [
    // where 'title' equals 'Title'
    'title',
];

protected $scopes = [
    // and custom parameter used in your scope
    'custom' => MyScope::class,
];
```

```php
class MyScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->where($scope, $value)->orWhere(...);
    }
}
```

Ordering by any field is available:

```php
protected $scopes = [
    // orderBy field
    'orderBy' => OrderByScope::class,
];
```

Package can also apply any custom criteria:

```php
return $this->news->withCriteria([
    new MyCriteria([
        'category_id' => '1',
        'name' => 'Name',
        ['created_at', '>', Time::now()],
    ]),
    ...
])->get();
```

## Usage

### Create a Model

Create your model:

```php
namespace App\Models;

use CodeIgniter\Model;

class News extends Model 
{
    ...
}
```

### Create a Repository

Extend it from `Fluent\Repository\Eloquent\BaseRepository` and provide `entity()` method to return full model class name:

```php
namespace App;

use AwesIO\Repository\Eloquent\BaseRepository;

class NewsRepository extends BaseRepository
{
    public function entity()
    {
        return new News();
    }
}
```

### Use built-in methods

```php
use App\NewsRepository;

class NewsController extends BaseController 
{
    protected $news;

    public function __construct()
    {
        $this->news = new NewsRepository();
    }
    ....
}
```

Execute the query as a "select" statement or get all results:

```php
$news = $this->news->get();
```

Execute the query and get the first result:

```php
$news = $this->news->first();
```

Find a model by its primary key:

```php
$news = $this->news->find(1);
```

Add basic where clauses and execute the query:

```php
$news = $this->news->->findWhere([
        // where id equals 1
        'id' => '1',
        // other "where" operations
        ['news_category_id', '<', '3'],
        ...
    ]);
```

Paginate the given query:

```php
$news = $this->news->paginate(15);
```

Add an "order by" clause to the query:

```php
$news = $this->news->orderBy('title', 'desc')->get();
```

Save a new model and return the instance:

```php
$news = $this->news->create($request->all());
```

Update a record:

```php
$this->news->update($request->all(), $id);
```

Delete a record by id:

```php
$this->news->destroy($id);
```

### Create a Criteria

Criteria are a way to build up specific query conditions.

```php
use Fluent\Repository\Contracts\CriterionInterface;

class MyCriteria implements CriterionInterface {

    protected $conditions;
    
    public function __construct(array $conditions)
    {
        $this->conditions = $conditions;
    }

    public function apply($entity)
    {
        foreach ($this->conditions as $field => $value) {
            $entity = $entity->where($field, $value);
        }

        return $entity;
    }
}
```

Multiple Criteria can be applied:

```php
use App\NewsRepository;

class NewsController extends BaseController 
{
    protected $news;

    public function __construct()
    {
        $this->news = new NewsRepository();
    }

    public function index()
    {
        return $this->news->withCriteria([
            new MyCriteria([
                'category_id' => '1', 'name' => 'Name'
            ]),
            new WhereAdmin(),
            ...
        ])->get();
    }
}
```

### Scope, Filter and Order

In your repository define which fields can be used to scope your queries by setting `$searchable` property.

```php
protected $searchable = [
    // where 'title' equals parameter value
    'title',
    // orWhere equals
    'body' => 'or',
    // where like
    'author' => 'like',
    // orWhere like
    'email' => 'orLike',
];
```

Search by searchables:

```php
public function index()
{
    return $this->news->scope(service('request'))->get();
}
```

```
https://example.com/news?title=Title&body=Text&author=&email=gmail
```

Also several serchables enabled by default:

```php
protected $scopes = [
    // orderBy field
    'orderBy' => OrderByScope::class,
    // where created_at date is after
    'begin' => WhereDateGreaterScope::class,
    // where created_at date is before
    'end' => WhereDateLessScope::class,
];
```

```php
$this->news->scope($request)->get();
```

Enable ordering for specific fields by adding `$orderable` property to your model class:

```php
public $orderable = ['email'];
```

```
https://example.com/news?orderBy=email_desc&begin=2019-01-24&end=2019-01-26
```

`orderBy=email_desc` will order by email in descending order, `orderBy=email` - in ascending

You can also build your own custom scopes. In your repository override `scope()` method:

```php
public function scope($request)
{
    // apply build-in scopes
    parent::scope($request);

    // apply custom scopes
    $this->entity = (new NewsScopes($request))->scope($this->entity);

    return $this;
}
```

Create your `scopes` class and extend `ScopesAbstract`

```php
use Fluent\Repository\Scopes\ScopesAbstract;

class NewsScopes extends ScopesAbstract
{
    protected $scopes = [
        // here you can add field-scope mappings
        'field' => MyScope::class,
    ];
}
```

Now you can build any scopes you need:

```php
use Fluent\Repository\Scopes\ScopeAbstract;

class MyScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->where($scope, $value);
    }
}
```

## Released under the MIT License, see [LICENSE](LICENSE).
