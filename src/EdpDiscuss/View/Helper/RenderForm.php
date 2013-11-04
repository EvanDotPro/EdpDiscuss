<?php
namespace EdpDiscuss\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RenderForm extends AbstractHelper
{
    public function __invoke($form)
    {
        // Prepare the form.
        $form->prepare();

        // Render the output.
        $form->setAttribute('class', 'form-horizontal');
        $output = $this->view->form()->openTag($form) . PHP_EOL;
        $elements = $form->getElements();
        foreach($elements as $element)
        {
            $hidden = ($element->getAttribute('type') == 'hidden');
            	
            if (!$hidden)
            {
                $messages = $element->getMessages();
                if (empty($messages)) {
                    $output .= '<div class="form-group">' . PHP_EOL;
                } else {
                    $output .= '<div class="form-group error">';
                }
            }

            // Render label if present.
            $label = $element->getLabel();
            if (isset($label) && '' !== $label)
            {
                $element->setLabelAttributes(array('class' => 'control-label'));
                $output .= $this->view->formLabel($element) . PHP_EOL;
            }

            // Render the actual element (and any errors)
            $output .= '<div class="controls">' . PHP_EOL;
            $output .= $this->view->formElement($element) . PHP_EOL;
            $output .= $this->view->formElementErrors($element) . PHP_EOL;
            $output .= '</div>' . PHP_EOL;

            if (!$hidden)
            {
                $output .= '</div>' . PHP_EOL;
            }
        }
        $output .= $this->view->form()->closeTag($form) . PHP_EOL;

        // Return the output.
        return $output;
    }
}