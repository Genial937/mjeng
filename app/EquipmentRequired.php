<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentRequired extends Model
{
    protected $fillable=[
        "site_id",
        "task_id",
        "equipment_type_id",
        "no_equipment",
        "payload_capacity",
        "payload_unit",
        "duration_unit",
        "duration",
        "currency",
        "lease_rates",
        "lease_modality",
        "fuel_provision",
        "cess_provision"
    ];

  public function equipmentType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
      return $this->belongsTo(EquipmentType::class);
  }
    public function site(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
    public function task(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
