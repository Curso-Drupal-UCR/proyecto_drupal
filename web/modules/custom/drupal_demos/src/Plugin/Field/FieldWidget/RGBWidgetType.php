<?php

namespace Drupal\drupal_demos\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgbwidget_type' widget.
 *
 * @FieldWidget(
 *   id = "rgbwidget_type",
 *   label = @Translation("Rgbwidget type"),
 *   field_types = {
 *     "rgbcolor_input"
 *   }
 * )
 */
class RGBWidgetType extends WidgetBase {

    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

        $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

        $element += [
            '#type' => 'textfield',
            '#default_value' => $value,
            '#size' => 7,
            '#maxlength' => 7,
            '#element_validate' => [
                [$this, 'validate'],
            ],
        ];

        return ['value' => $element];
    }

    public function validate($element, FormStateInterface $form_state) {
        $value = $element['#value'];
        if (strlen($value) == 0) {
            $form_state->setValueForElement($element, '');
            return;
        }
        if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
            $form_state->setError($element, t("Color must be a 6-digit hexadecimal value, suitable for CSS."));
        }
    }

}
