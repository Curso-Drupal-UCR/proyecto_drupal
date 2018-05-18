<?php

namespace Drupal\ejemplo_drupal\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'pais_formatter_type' formatter.
 *
 * @FieldFormatter(
 *   id = "pais_formatter_type",
 *   label = @Translation("Pais formatter type"),
 *   field_types = {
 *     "pais_field_type"
 *   }
 * )
 */
class PaisFormatterType extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [ ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        return [ ] + parent::settingsForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $paises = \Drupal::service('country_manager')->getlist();
        $elements = [];
        $elements['#attached']['library'][] = 'ejemplo_drupal/ejemplo_drupal.flags';


        foreach ($items as $delta => $item) {
            $elements[$delta] = [
                '#type' => 'item',
                '#markup' => '<p><span class="flag-icon flag-icon-' . strtolower($item->value) . '"></span>' . $paises[$item->value] . '</p>',
            ];
        }

        /*'#attached' => [
            'library' => [
                'libraries/flag-icon-css',
            ],
        ]*/

        return $elements;
    }
}
