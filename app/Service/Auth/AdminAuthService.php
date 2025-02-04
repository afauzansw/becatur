<?php

namespace App\Service\Auth;

use App\Contract\Auth\AdminAuthContract;
use App\Models\Admin;
use App\Service\AuthBaseService;
use Illuminate\Database\Eloquent\Model;

class AdminAuthService extends AuthBaseService implements AdminAuthContract
{
    protected string $username = 'email';
    protected string|null $guard = 'admin';
    protected string|null $guardForeignKey = null;
    protected Model $model;

    /**
     * Repositories constructor.
     *
     * @param Model $model
     */
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

}
