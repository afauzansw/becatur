<?php

namespace App\Contract;

interface BaseContract
{
    public function all($allowedFilters, $allowedSorts, bool|null $withPaginate = null, array $relation = []);

    public function find($id, array $relation = []);

    public function create($payloads);

    public function update($id, $payloads);

    public function destroy($id);

    public function getWithCondition($conditions, $allowedFilters, $allowedSorts, bool|null $withPaginate = null);

    public function updateWithCondition($conditions, $payloads);
}
