<?php

namespace Drupal\entityreferenceview\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'entity_reference_view_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "entity_reference_view_field_formatter",
 *   label = @Translation("Entity reference view field formatter"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class EntityReferenceViewFieldFormatter extends EntityReferenceFormatterBase {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
                'path_view' => ''
            ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {

        $formulario = parent::settingsForm($form, $form_state);

        $formulario['path_view'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Link a la vista'),
            '#default_value' => $this->getSetting('path_view'),
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE
        ];

        return $formulario;

    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];

        if (!empty($this->getSetting('path_view'))) {
            $summary[] =
                $this->t('El enlace a la vista es: @path',
                    ['@path' => $this->getSetting('path_view')]
                );
        }

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($this->getEntitiesToView($items, $langcode) as $delta => $item) {
            $elements[$delta] = ['#markup' => $this->viewValue($item)];
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
    protected function viewValue(EntityInterface $entity) {
        global $base_url;

        $label = $entity->label();
        $id = $entity->id();

        $urlView = $base_url . '/' . $this->getSetting('path_view') .'/'. $id;
        $url = Url::fromUri($urlView);
        $link = Link::fromTextAndUrl(
            $this->t('@NombreActor',
                ['@NombreActor' => $label]
            ), $url);

        return $link->toString();

    }

}
