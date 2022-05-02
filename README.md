[![Stand With Ukraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner2-direct.svg)](https://vshymanskyy.github.io/StandWithUkraine/)

# Laravel Nova KeyInput Field

Based on [KeyValue Field](https://nova.laravel.com/docs/4.0/resources/fields.html#keyvalue-field)

```php
KeyInput::make(__('Prices'), 'prices')
    ->rules('json')
    ->disableEditingKeys()
    ->disableAddingRows()
    ->disableDeletingRows()
    ->keyLabel(__('Country'))
    ->valueLabel(__('Price'))
    ->type('number')
    ->step(0.01)
    ->min(0)
    ->max(5000)
    ->required()
```
