<?php

namespace App\Services;

use App\Services\ServiceInterface;

abstract class BaseService implements ServiceInterface
{
    protected $repo;

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function repo();

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->makeRepo();
    }

    public function makeRepo()
    {
        $repo = app()->make($this->repo());

        // if (! $repo instanceof Model) {
        //     throw new GeneralException("Class {$this->model()} must be an instance of ".Model::class);
        // }

        return $this->repo = $repo;
    }

    /**
     * @return fixed
     */
    public function create(array $data = [])
    {
        return $this->repo->create($data);
    }

    /**
     * @param  int  $limit
     * @param  string  $pageName
     * @param  null  $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->repo->paginate($limit, $columns, $pageName, $page);
    }

    /**
     * Get all the model records in the database.
     *
     *
     * @return Collection|static[]
     */
    public function getAll(array $columns = ['*'])
    {
        return $this->repo->all($columns);
    }

    /**
     * Get the specified model record from the database.
     *
     *
     * @return Collection|Model
     */
    public function getById($id, array $columns = ['*'])
    {
        return $this->repo->getById($id, $columns);
    }

    /**
     * Update the specified model record in the database.
     *
     *
     * @return Collection|Model
     */
    public function updateById($id, array $data, array $options = [])
    {
        return $this->repo->updateById($id, $data, $options);
    }

    /**
     * Delete the specified model record from the database.
     *
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function deleteById($id): bool
    {
        return $this->repo->deleteById($id);
    }
}
