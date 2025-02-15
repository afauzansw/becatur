<?php

namespace App\Service;

use App\Contract\BaseContract;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class BaseService implements BaseContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;

    /**
     * Repositories constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function build(): Model
    {
        return $this->model;
    }

    /**
     * Get user id by guard name.
     *
     * @return int
     */
    public function userID(): int
    {
        return Auth::guard($this->guard)->id();
    }

    /**
     * Get all items from resource.
     *
     * @param $allowedFilters
     * @param $allowedSorts
     * @param bool|null $withPaginate
     * @return array|Exception|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\HigherOrderWhenProxy[]|QueryBuilder[]
     */
    public function all($allowedFilters, $allowedSorts, bool|null $withPaginate = null, array $relation = [])
    {
        try {
            $model = QueryBuilder::for($this->model::class)
                ->allowedFilters($allowedFilters)
                ->allowedSorts($allowedSorts)
                ->with(empty($relation) ? $this->relation : $relation)
                ->when(!is_null($this->guardForeignKey), function ($query) {
                    $query->where($this->guardForeignKey, $this->userID());
                })
                ->latest()
                ->when(!is_null($this->guardForeignKey), function ($query) {
                    $query->paginate()->appends(request()->query());
                });

            if (is_null($withPaginate))
                $withPaginate = config('service-contract.default_paginated');
            if (!$withPaginate)
                return $model->get();

            $result = $model->paginate(config('service-contract.pagination_per_page'))
                ->appends(request()->query());

            return [
                'items' => $result->items(),
                'prev_page' => $result->currentPage() > 1 ? $result->currentPage() - 1 : null,
                'current_page' => $result->currentPage(),
                'next_page' => $result->hasMorePages() ? $result->currentPage() + 1 : null
            ];
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Find item by id from resource.
     *
     * @param mixed $id
     * @return Exception|\Illuminate\Database\Eloquent\Collection
     */
    public function find($id, array $relation = [])
    {
        try {
            return $this->model
                ->with(empty($relation) ? $this->relation : $relation)
                ->when(!is_null($this->guardForeignKey), function ($query) {
                    $query->where($this->guardForeignKey, $this->userID());
                })
                ->findOrFail($id);
        } catch (Exception $e) {
            ;
            return $e;
        }
    }

    /**
     * Create new item to resource.
     *
     * @param $payloads
     * @return Exception|true
     */
    public function create($payloads)
    {
        try {
            if (!is_null($this->guardForeignKey)) {
                $payloads[$this->guardForeignKey] = $this->userID();
            }

            DB::beginTransaction();
            $model = $this->model->create($payloads);

            foreach ($this->fileKeys as $fileKey) {
                $model->addMultipleMediaFromRequest([$fileKey])
                    ->each(function ($image) use ($fileKey) {
                        $image->toMediaCollection($fileKey);
                    });
            }

            DB::commit();

            return $model->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Update item from resource.
     *
     * @param mixed $id
     * @param mixed $payloads
     * @return Exception|\Illuminate\Database\Eloquent\Collection
     */
    public function update($id, $payloads)
    {
        try {
            if (!is_null($this->guardForeignKey)) {
                $payloads[$this->guardForeignKey] = $this->userID();
            }

            $payloadsData = $payloads;

            foreach ($this->fileKeys as $fileKey) {
                unset($payloadsData[$fileKey]);
            }

            DB::beginTransaction();

            $model = $this->model->findOrFail($id);
            $model->update($payloadsData);

            foreach ($this->fileKeys as $fileKey) {
                $model->addMultipleMediaFromRequest([$fileKey])
                    ->each(function ($image) use ($fileKey) {
                        $image->toMediaCollection($fileKey);
                    });
            }

            DB::commit();

            return $this->model->find($id);
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Destroy item from resource.
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $model = $this->model
                ->when(!is_null($this->guardForeignKey), function ($query) {
                    $query->where($this->guardForeignKey, $this->userID());
                })
                ->findOrFail($id)
                ->delete();
            DB::commit();

            return $model;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Get items with certain conditions.
     *
     * @param mixed $conditions
     * @param mixed $allowedFilters
     * @param mixed $allowedSorts
     * @param bool|null $withPaginate
     * @return mixed
     */
    public function getWithCondition($conditions, $allowedFilters, $allowedSorts, bool|null $withPaginate = null)
    {
        try {
            $model = QueryBuilder::for($this->model::class)
                ->where(...$conditions)
                ->allowedFilters($allowedFilters)
                ->allowedSorts($allowedSorts)
                ->with($this->relation)
                ->when(!is_null($this->guardForeignKey), function ($query) {
                    $query->paginate()->appends(request()->query());
                })
                ->latest();

            if (is_null($withPaginate))
                $withPaginate = config('service-contract.default_paginated');
            if (!$withPaginate)
                return $model->get();

            $result = $model->paginate(config('service-contract.pagination_per_page'))
                ->appends(request()->query());

            return [
                'items' => $result->items(),
                'prev_page' => $result->currentPage() > 1 ? $result->currentPage() - 1 : null,
                'current_page' => $result->currentPage(),
                'next_page' => $result->hasMorePages() ? $result->currentPage() + 1 : null
            ];
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Update items with certain conditions.
     *
     * @param $conditions
     * @param $payloads
     * @return mixed
     */
    public function updateWithCondition($conditions, $payloads)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->where($conditions);
            $model->update($payloads);
            DB::commit();

            return $model->first();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
