<?php

namespace Drupal\pais\Plugin\Field\FieldFormatter;

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
        $elements = [];

        // $elements['#attached']['library'][] = 'ejemplo_drupal/ejemplo_drupal.flags';
        foreach ($items as $delta => $item) {
            $elements[$delta] = [
                '#markup' => $this->viewValue($item),
            ];
        }

        return $elements;
    }

    /**
     * Generate the output appropriate for one field item.
     *
     * @param \Drupal\Core\Field\FieldItemInterface $item
     *   One field item.
     *
     * @return string
     *   The textual output generated.
     */
    protected function viewValue(FieldItemInterface $item) {
        return nl2br(Html::escape($item->value));
    }

}
