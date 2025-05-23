<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Relation
 */
class Relation extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    public $table = 'relations';

    public static $searchable = [
        'name',
        'type',
        'description',
        'order_number',
        'reference',
        'comments',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'description',
        'attributes',
        'reference',
        'responsible',
        'order_number',
        'active',
        'start_date',
        'end_date',
        'comments',
        'importance',
        'source_id',
        'destination_id',
        'is_hierarchical',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'source_id')->orderBy('name');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'destination_id')->orderBy('name');
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(RelationValue::class, 'relation_id', 'id')->orderBy('date_price');
    }
}
