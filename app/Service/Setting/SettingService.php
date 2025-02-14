<?php

namespace App\Service\Setting;

use App\Contract\Setting\SettingContract;
use App\Models\Setting;
use App\Service\BaseService;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;

class SettingService extends BaseService implements SettingContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = ['qris_image'];
    protected Model $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function update($id, $payloads)
    {
        try {
            if (!is_null($this->guardForeignKey)) {
                $payloads[$this->guardForeignKey] = $this->userID();
            }

            // foreach ($this->fileKeys as $fileKey) {
            //     unset($payloads['qris_image']);
            // }

            DB::beginTransaction();

            $model = $this->model->findOrFail($id);
            $model->update($payloads);

            $model->addMediaFromRequest('qris_image')->toMediaCollection('qris_image');

            DB::commit();

            return $this->model->find($id);
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
