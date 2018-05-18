<?php

namespace Drupal\itc\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldWidget(
 *  id = "country_default_widget",
 *  label = @Translation("Country Default"),
 *  field_types = {
 *      "country"
 *  }
 * )
 */

class CountryDefaultWidget extends WidgetBase {

    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        $elements = [];
        $value = isset($items[$delta]->value) ? $items[$delta]->value : '';
        $elements['value'] = [
            '#type' => 'select',
            '#options' => \Drupal::service('country_manager')->getList(),
            '#title' => t('Select country'),
            '#default_value' => $value
        ];

        return $elements;
    }
}

//https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Locale%21CountryManager.php/function/CountryManager%3A%3AgetList/8.2.x