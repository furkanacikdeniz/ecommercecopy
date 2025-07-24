<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    private bool $checked;
    private string $label;
    private string $field;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $checked = false, string $label, string $field)
    {
        $this->checked = $checked;
        $this->label = $label;
        $this->field = $field;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox', [
            'checked'=> $this->checked,
            'label'=> $this->label,
            'field'=> $this->field
        ]);

    }
}
