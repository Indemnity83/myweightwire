<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property User user
 * @property int user_id
 * @property \Carbon\Carbon weighed_at
 * @property float weight
 * @property float|null loss
 */
class Weighin extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'weighed_at' => 'date',
        'loss' => 'decimal:2',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'weighed_at',
        'weight',
        'loss',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Order by date ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('weighed_at', 'asc');
        });
    }

    /**
     * Record a weighin.
     *
     * @param User $user
     * @param float $weight
     * @param Carbon $weighed_at
     * @return Weighin
     */
    public static function record($user, $weight, $weighed_at)
    {
        $weighin = new self();
        $weighin->forceFill([
            'user_id' => $user->id,
            'weight' => $weight,
            'weighed_at' => $weighed_at,
        ]);
        $weighin->save();

        return $weighin;
    }

    /**
     * User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Limit query to specific date.
     *
     * @param Builder $query
     * @param $weighed_at
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeOn(Builder $query, $weighed_at)
    {
        return $query->whereDate('weighed_at', $weighed_at);
    }

    /**
     * Limit query dates on or before given date.
     *
     * @param Builder $query
     * @param $weighed_at
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeOnOrBefore(Builder $query, $weighed_at)
    {
        return $query->whereDate('weighed_at', '<=', $weighed_at)
            ->withoutGlobalScope('order')
            ->orderBy('weighed_at', 'desc');
    }

    /**
     * Limit query dates on or after given date.
     *
     * @param Builder $query
     * @param $weighed_at
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeOnOrAfter(Builder $query, $weighed_at)
    {
        return $query->whereDate('weighed_at', '>=', $weighed_at)
            ->withoutGlobalScope('order')
            ->orderBy('weighed_at', 'asc');
    }

    /**
     * Limit query dates between (inclusive) two dates.
     *
     * @param Builder $query
     * @param Carbon $start
     * @param Carbon $end
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeBetween(Builder $query, $start, $end)
    {
        return $query->whereBetween('weighed_at', [$start, $end]);
    }

    /**
     * Limit query dates prior to (non-inclusive) the given date.
     *
     * @param Builder $query
     * @param $weighed_at
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopePriorTo(Builder $query, $weighed_at)
    {
        return $query->whereDate('weighed_at', '<', $weighed_at)
            ->withoutGlobalScope('order')
            ->orderBy('weighed_at', 'desc');
    }

    /**
     * Limit query dates after (non-inclusive) the given date.
     *
     * @param Builder $query
     * @param $weighed_at
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeAfter(Builder $query, $weighed_at)
    {
        return $query->whereDate('weighed_at', '>', $weighed_at);
    }

    /**
     * Set the weight value.
     *
     * Weighs are stored in the db in tenths of a pound.
     *
     * @param $value
     */
    public function setWeightAttribute($value)
    {
        $this->attributes['weight'] = $value * 10;
    }

    /**
     * Get the weight value.
     *
     * Weighs are stored in the db in tenths of a pound.
     *
     * @param $value
     * @return string
     */
    public function getWeightAttribute($value)
    {
        return number_format($value / 10, 1);
    }
}
