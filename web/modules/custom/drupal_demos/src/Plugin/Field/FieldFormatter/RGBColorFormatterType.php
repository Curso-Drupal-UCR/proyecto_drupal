<?php

namespace Drupal\drupal_demos\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgbcolor_formatter_type' formatter.
 *
 * @FieldFormatter(
 *   id = "rgbcolor_formatter_type",
 *   label = @Translation("Rgbcolor formatter type"),
 *   field_types = {
 *     "rgbcolor_input"
 *   }
 * )
 */
class RGBColorFormatterType extends FormatterBase {

    /**
     * Inside this method we can customize how the field is displayed inside
     * pages.
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($items as $delta => $item) {
            $elements[$delta] = $this->viewValue($item);
        }

        return $elements;
    }

    private function viewValue(FieldItemInterface $item) {
        return [
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => $this->t('The color value is: @color', ['@color' => $item->value]),
            '#attributes' => [
                'style' => 'background-color: ' . $item->value
            ]
        ];
    }
}
