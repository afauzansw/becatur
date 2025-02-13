<?php

namespace App\Service\User;

use App\Contract\User\UserContract;
use App\Models\User;
use App\Service\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService implements UserContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
