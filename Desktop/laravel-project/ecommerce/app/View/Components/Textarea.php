<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    private string $label;
    private string $value;
    private string $placeholder;
    private string $field;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $value="", string $placeholder, string $field)
    {
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea',[
            'label'=> $this->label,
            'value'=> $this->value,
            'placeholder'=> $this->placeholder,
            'field'=> $this->field
        ]);
    }
}
