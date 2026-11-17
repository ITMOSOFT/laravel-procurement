<?php
namespace ITMOSOFT\Procurement\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ProcurementRequestItem extends Model {
 protected $table='procurement_request_items'; protected $guarded=[];
 protected function casts(): array { return ['quantity'=>'decimal:4','estimated_unit_cost'=>'decimal:2','estimated_total'=>'decimal:2','metadata'=>'array']; }
 public function request(): BelongsTo { return $this->belongsTo(ProcurementRequest::class, 'procurement_request_id'); }
}
