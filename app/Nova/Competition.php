<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\HasMany;
use App\Nova\Actions\SetMatchups;
use Laravel\Nova\Fields\BelongsToMany;

class Competition extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Competition';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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

            Text::make('Name')
                ->rules(['required'])
                ->sortable(),

            Date::make('Starts On')
                ->rules(['required', 'date'])
                ->sortable(),

            Number::make('Duration')
                ->rules(['required', 'int', 'min:1'])
                ->sortable(),

            BelongsToMany::make('Users'),

            HasMany::make('Matchups'),
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
            new SetMatchups,
        ];
    }
}
