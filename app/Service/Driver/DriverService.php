<?php

namespace App\Service\Driver;

use App\Contract\Driver\DriverContract;
use App\Models\Driver;
use App\Service\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriverService extends BaseService implements DriverContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;

    public function __construct(Driver $model)
    {
        $this->model = $model;
    }

    public function setOnlineStatus()
    {
        try {
            DB::beginTransaction();

            $id = Auth::guard('driver')->id();

            $model = $this->model->find($id);
            $model->update(['is_online' => !$model->is_online]);

            DB::commit();

            return $model->first();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
