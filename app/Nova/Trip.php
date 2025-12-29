<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class Trip extends Resource
{
    public static $model = \App\Models\Trip::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title', 'title_en', 'slug', 'location', 'location_en'
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Title')->sortable()->rules('required', 'max:255')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    $model->{$attribute} = $request->get($requestAttribute);
                    // Auto-generate slug from title if slug is empty
                    if (empty($model->slug)) {
                        $model->slug = Str::slug($request->get($requestAttribute));
                    }
                }),

            Text::make('Slug', 'slug')->sortable()
                ->rules('nullable', 'max:255', 'unique:trips,slug,{{resourceId}}')
                ->help('Auto-generated from title if left empty')
                ->hideFromIndex(),

            Text::make('Title (English)', 'title_en')->nullable()->hideFromIndex(),

            // Required fields
            Textarea::make('Description')->rules('required')->hideFromIndex(),
            Textarea::make('Description (English)', 'description_en')->nullable()->hideFromIndex(),
            
            Textarea::make('Short Description', 'short_description')->nullable()->hideFromIndex(),
            Textarea::make('Short Description (English)', 'short_description_en')->nullable()->hideFromIndex(),

            Number::make('Price', 'price')
                ->step(0.01)
                ->sortable()
                ->rules('required', 'numeric', 'min:0'),

            Number::make('Duration')
                ->sortable()
                ->rules('required', 'integer', 'min:1')
                ->help('Duration in days'),

            Number::make('Capacity', 'max_participants')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Min Participants', 'min_participants')
                ->sortable()
                ->default(1)
                ->rules('nullable', 'integer', 'min:1'),

            Text::make('Location')
                ->rules('required', 'max:255')
                ->hideFromIndex(),
            Text::make('Location (English)', 'location_en')->nullable()->hideFromIndex(),

            Code::make('Included', 'included_items')
                ->json()
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'json'),
            Code::make('Included (English)', 'included_items_en')
                ->json()
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'json'),
            Code::make('Excluded', 'excluded_items')
                ->json()
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'json'),
            Code::make('Excluded (English)', 'excluded_items_en')
                ->json()
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'json'),
            Code::make('Requirements')
                ->json()
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'json'),
            Code::make('Requirements (English)', 'requirements_en')
                ->json()
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'json'),

            DateTime::make('Start Date', 'start_date')
                ->rules('required', 'date')
                ->help('Trip start date and time'),

            DateTime::make('End Date', 'end_date')
                ->rules('required', 'date', 'after:start_date')
                ->help('Trip end date and time'),

            Text::make('Meeting Point', 'meeting_point')
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'max:255'),
            Text::make('Meeting Point (English)', 'meeting_point_en')
                ->nullable()
                ->hideFromIndex()
                ->rules('nullable', 'max:255'),

            Select::make('Difficulty Level', 'difficulty_level')
                ->options([
                    'easy' => 'Easy',
                    'medium' => 'Medium',
                    'hard' => 'Hard',
                    'expert' => 'Expert',
                ])
                ->default('medium')
                ->displayUsingLabels()
                ->rules('required', 'in:easy,medium,hard,expert'),

            Select::make('Type')
                ->options([
                    'trip' => 'Trip',
                    'experience' => 'Experience',
                    'adventure' => 'Adventure',
                ])
                ->default('trip')
                ->displayUsingLabels()
                ->rules('required', 'in:trip,experience,adventure'),

            Textarea::make('Cancellation Policy', 'cancellation_policy')
                ->nullable()
                ->hideFromIndex(),
            Textarea::make('Cancellation Policy (English)', 'cancellation_policy_en')
                ->nullable()
                ->hideFromIndex(),

            BelongsTo::make('Guide', 'guide', Guide::class)
                ->rules('required')
                ->help('Select the guide for this trip'),

            Select::make('Category', 'category_id')
                ->options(function () {
                    return \App\Models\TripCategory::where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray();
                })
                ->rules('required', 'integer', 'exists:trip_categories,id')
                ->help('Select the trip category for this trip')
                ->displayUsingLabels()
                ->searchable(),

            Boolean::make('Is Active', 'is_active')->default(true),
            Boolean::make('Is Featured', 'is_featured')->default(false),
            Boolean::make('Has Story', 'has_story')->default(false),

            Number::make('Rating')->step(0.1)->sortable()->default(0)->readonly(),
            Number::make('Total Bookings', 'total_bookings')->sortable()->default(0)->readonly(),
        ];
    }

    public function cards(NovaRequest $request): array
    {
        return [];
    }

    public function filters(NovaRequest $request): array
    {
        return [];
    }

    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
