<?php

namespace App\Service;

use App\Contract\Admin\AdminContract;
use App\Models\Admin;
use Exception;
use Illuminate\Database\Eloquent\Model;

class AdminService extends BaseService implements AdminContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
