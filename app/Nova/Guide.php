<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class Guide extends Resource
{
    public static $model = \App\Models\Guide::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'name_en', 'email', 'phone', 'slug'
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            // Basic Information
            Text::make('Name')->sortable()->rules('required', 'max:255')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    $model->{$attribute} = $request->get($requestAttribute);
                    // Auto-generate slug from name if slug is empty
                    if (empty($model->slug)) {
                        $model->slug = Str::slug($request->get($requestAttribute));
                    }
                }),

            Text::make('Slug', 'slug')->sortable()
                ->rules('nullable', 'max:255', 'unique:guides,slug,{{resourceId}}')
                ->help('Auto-generated from name if left empty')
                ->hideFromIndex(),

            Text::make('Email')->sortable()->rules('required', 'email', 'unique:guides,email,{{resourceId}}'),
            Text::make('Phone')->nullable(),

            // Profile Information
            Text::make('Bio')->hideFromIndex()->nullable(),
            Image::make('Profile Image', 'profile_image')
                ->disk('public')
                ->path('guides')
                ->nullable()
                ->help('Upload a profile image for the guide'),

            // Professional Information
            Code::make('Specialties')->json()->nullable()
                ->help('Enter specialties as JSON array, e.g., ["History", "Heritage"]'),
            Code::make('Languages')->json()->nullable()
                ->help('Enter languages as JSON array, e.g., ["Arabic", "English"]'),
            Code::make('Certifications')->json()->nullable()
                ->help('Enter certifications as JSON array'),
            Number::make('Experience Years', 'experience_years')
                ->sortable()
                ->default(0)
                ->rules('nullable', 'integer', 'min:0'),

            // Statistics (Read-only)
            Number::make('Rating')->step(0.1)->sortable()->default(0)->readonly(),
            Number::make('Total Trips', 'total_trips')->sortable()->default(0)->readonly(),

            // Status
            Boolean::make('Is Active', 'is_active')->default(true),

            // English Content
            Text::make('Name (English)', 'name_en')->nullable()->hideFromIndex(),
            Text::make('Bio (English)', 'bio_en')->nullable()->hideFromIndex(),
            Code::make('Specialties (English)', 'specialties_en')->json()->nullable()->hideFromIndex(),
        ];
    }
}
