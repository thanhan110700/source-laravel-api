<?php

namespace App\Services;

/**
 * Interface ServiceInterface.
 */
interface ServiceInterface
{
    public function makeRepo();

    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null);

    public function getAll(array $columns);
    
    public function getById($id, array $columns);
    
    public function create(array $data = []);

    public function updateById($id, array $data, array $options = []);

    public function deleteById($id): bool;
}
