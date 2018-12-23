<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property User user
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
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'weighed_at',
        'weight',
    ];

    protected static function boot()
    {
        parent::boot();

        // Order by date ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('weighed_at', 'asc');
        });
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
