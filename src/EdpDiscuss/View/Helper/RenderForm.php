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

            $offset = "";
            if ($element->getAttribute('type') == 'submit')
            {
            	$offset ="col-sm-offset-2 ";
            }
            
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
                $element->setLabelAttributes(array('class' => 'col-sm-2 control-label'));
                $output .= $this->view->formLabel($element) . PHP_EOL;
            }

            // Render the actual element (and any errors)
            if (!$hidden)
            {
                $output .= '<div class=" ' . $offset . 'col-sm-10">' . PHP_EOL;
            }
            $output .= $this->view->formElement($element) . PHP_EOL;
            $output .= $this->view->formElementErrors($element) . PHP_EOL;
            if (!$hidden)
            {
                $output .= '</div>' . PHP_EOL;
            }

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