<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Booking>
     */
    public static $model = \App\Models\Booking::class;

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
        'id', 'status', 'payment_status', 'payment_method'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Trip', 'trip', Trip::class)
                ->withoutTrashed()
                ->help('Select a trip for this booking'),

            BelongsTo::make('User', 'user', User::class)
                ->help('Select a user for this booking'),

            Text::make('Phone Number')
                ->rules('nullable', 'string', 'max:20')
                ->sortable(),

            Number::make('Participants Count')
                ->rules('required', 'integer', 'min:1'),

            Number::make('Total Amount')
                ->step(0.01)
                ->rules('required', 'numeric'),

            DateTime::make('Booking Date')
                ->rules('required', 'date'),

            Select::make('Status', 'status')->options([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'cancelled' => 'Cancelled',
                'completed' => 'Completed',
            ])->displayUsingLabels()
            ->rules('required', 'in:pending,confirmed,cancelled,completed'),

            Select::make('Payment Status', 'payment_status')->options([
                'pending' => 'Pending',
                'paid' => 'Paid',
                'refunded' => 'Refunded',
            ])->displayUsingLabels()
            ->rules('required', 'in:pending,paid,refunded'),

            Select::make('Payment Method', 'payment_method')->options([
                'visa' => 'Visa',
                'mada' => 'Mada',
                'paypal' => 'PayPal',
                'apple_pay' => 'Apple Pay',
                'tabby' => 'Tabby',
                'tamara' => 'Tamara',
                'bank_transfer' => 'Bank Transfer',
            ])->displayUsingLabels()
            ->nullable()
            ->rules('nullable', 'in:visa,mada,paypal,apple_pay,tabby,tamara,bank_transfer'),

            Textarea::make('Notes')->nullable(),

            Textarea::make('Emergency Contact')
                ->nullable()
                ->help('Store emergency contact details as JSON if multiple.'),

            Textarea::make('Special Requirements')
                ->nullable()
                ->help('Store special requirements as JSON if multiple.'),
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

    /**
     * Build a "relatable" query for Trips.
     */
    public static function relatableTrips(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "relatable" query for Users.
     */
    public static function relatableUsers(NovaRequest $request, $query)
    {
        return $query;
    }
}
