<?php

namespace ITMOSOFT\Procurement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use InvalidArgumentException;

class ProcurementRequest extends Model
{
    protected $table = 'procurement_requests';
    protected $guarded = [];

    protected function casts(): array
    {
        return ['needed_by' => 'date', 'estimated_total' => 'decimal:2', 'reviewed_at' => 'datetime', 'metadata' => 'array',];
    }


    public function requester(): MorphTo { return $this->morphTo(); }
    public function account(): MorphTo { return $this->morphTo(); }
    public function reviewer(): MorphTo { return $this->morphTo(); }
    public function items(): HasMany { return $this->hasMany(ProcurementRequestItem::class)->orderBy('position'); }



    public function submit(): bool
    {
        if ($this->status !== 'draft') return false;
        $this->status = 'submitted';
        return $this->save();
    }

    public function approve(?Model $reviewer = null, ?string $notes = null): bool
    {
        if ($this->status !== 'submitted') return false;
        $this->status = 'approved';
        $this->reviewed_at = now();
        $this->decision_notes = $notes;
        if ($reviewer) {
            $this->reviewer_type = $reviewer->getMorphClass();
            $this->reviewer_id = $reviewer->getKey();
        }
        return $this->save();
    }

    public function reject(?Model $reviewer = null, ?string $notes = null): bool
    {
        if ($this->status !== 'submitted') return false;
        $this->status = 'rejected';
        $this->reviewed_at = now();
        $this->decision_notes = $notes;
        if ($reviewer) {
            $this->reviewer_type = $reviewer->getMorphClass();
            $this->reviewer_id = $reviewer->getKey();
        }
        return $this->save();
    }

    public function cancel(): bool
    {
        if (! in_array($this->status, ['draft', 'submitted', 'approved'], true)) return false;
        $this->status = 'cancelled';
        return $this->save();
    }

}
