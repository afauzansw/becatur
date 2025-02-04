<?php

namespace App\Service\Auth;

use App\Contract\Auth\UserAuthContract;
use App\Models\User;
use App\Service\AuthBaseService;
use Illuminate\Database\Eloquent\Model;

class UserAuthService extends AuthBaseService implements UserAuthContract
{
    protected string $username = 'email';
    protected string|null $guard = 'api';
    protected string|null $guardForeignKey = null;
    protected bool $withToken = true;
    protected Model $model;

    /**
     * Repositories constructor.
     *
     * @param Model $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

}
