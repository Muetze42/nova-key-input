<?php

namespace NormanHuth\KeyInput;

use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class KeyInput extends KeyValue
{
    protected string $type = 'text';
    protected ?float $min = null;
    protected ?float $max = null;
    protected ?float $step = null;
    protected bool $required = false;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'key-value-field';

    /**
     * Change the component input type
     *
     * @param string $type
     * @return $this
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * The minimum value that can be assigned to the field.
     *
     * @param float $min
     * @return $this
     */
    public function min(float $min): static
    {
        $this->min = $min;

        return $this;
    }

    /**
     * The maximum value that can be assigned to the field.
     *
     * @param float $max
     * @return $this
     */
    public function max(float $max): static
    {
        $this->max = $max;

        return $this;
    }

    /**
     * The step size the field will increment and decrement by.
     *
     * @param float $step
     * @return $this
     */
    public function step(float $step): static
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Set the callback used to determine if the field is required.
     *
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):bool)|bool|null  $callback
     * @return Field
     */
    public function required($callback = true): Field
    {
        $this->required = $callback;

        return parent::required($callback);
    }

    /**
     * Get the component name for the field.
     *
     * @return string
     */
    public function component(): string
    {
        if (isset(static::$customComponents[get_class($this)])) {
            return static::$customComponents[get_class($this)];
        }

        if (request()->input('editing')) {
            return 'key-input';
        }

        return parent::component();
    }

    /**
     * Prepare the field element for JSON serialization.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'keyLabel'     => $this->keyLabel ?? __('Key'),
            'valueLabel'   => $this->valueLabel ?? __('Value'),
            'actionText'   => $this->actionText ?? __('Add row'),
            'readonlyKeys' => $this->readonlyKeys(app(NovaRequest::class)),
            'canAddRow'    => $this->canAddRow,
            'canDeleteRow' => $this->canDeleteRow,
            'type'         => $this->type,
            'min'          => $this->min,
            'max'          => $this->max,
            'step'         => $this->step,
            'required'     => $this->required,
        ]);
    }
}
