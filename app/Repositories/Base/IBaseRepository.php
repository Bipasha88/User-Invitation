<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    public function all(array $columns = ['*']);
    public function count(): int;
    public function create(array $data);
    public function createMultiple(array $data);
    public function delete();
    public function deleteById($id): bool;
    public function deleteModel(Model $model): bool;
    public function deleteMultipleById(array $ids): int;
    public function first(array $columns = ['*']);
    public function get(array $columns = ['*']);
    public function getById($id, array $columns = ['*']);
    public function getByColumn($item, $column, array $columns = ['*']);
    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null);
    public function updateById($id, array $data, array $options = []);
    public function update(Model $model, array $data, array $options = []);
    public function limit($limit);
    public function orderBy($column, $direction = 'asc');
    public function where($column, $value, $operator = '=');
    public function whereIn($column, $values);
    public function with($relations);
    public function filteredQuery($filter = array());
}
