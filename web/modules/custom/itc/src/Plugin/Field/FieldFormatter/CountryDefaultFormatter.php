<?php

namespace Drupal\itc\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * @FieldFormatter(
 *  id = "country_default_formatter",
 *  label = @Translation("Country"),
 *  field_types = {
 *      "country"
 *  }
 * )
 *
 * */

class CountryDefaultFormatter extends FormatterBase {

    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        $countries = \Drupal::service('country_manager')->getList();
        foreach ($items as $delta => $item) {
            if (isset($countries[$item->value])) {
                $elements[$delta] = [
                    '#type' => 'markup',
                    '#markup' => '<p>' . $countries[$item->value] . '</p>'
                ];
            }
        }

        return $elements;
    }
}