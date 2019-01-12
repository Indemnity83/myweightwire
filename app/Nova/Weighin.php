<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use App\Nova\Actions\UpdateLoss;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsTo;

class Weighin extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Weighin';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),

            BelongsTo::make('User')
                ->rules(['required']),

            Date::make('Weighed At')
                ->rules(['required', 'date']),

            Password::make('Weight')
                ->rules(['required', 'numeric', 'between:100,300']),

            Number::make('Loss')
                ->exceptOnForms(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new UpdateLoss,
        ];
    }
}
