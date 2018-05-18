<?php

namespace Drupal\drupal_demos\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
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
        return ['view_path' => ''] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {

        $elements = [];

        $elements['view_path'] = ['#title' => t('Path de la vista que desea utilizar'), '#type' => 'textfield', '#default_value' => $this->getSetting('view_path')];

        return $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];

        if (!empty($this->getSetting('view_path'))) {
            $summary[] = $this->t('Path: @path', ['@path' => $this->getSetting('view_path')]);
        }

        return $summary;
    }

    /**
     * @param FieldItemListInterface $items
     * @param string $langcode
     * @return array
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];
        foreach ($this->getEntitiesToView($items, $langcode) as $delta => $entity) {
            $elements[$delta] = ['#markup' => $this->viewValue($entity)];
        }
        return $elements;
    }

    /**
     * Generate the output appropriate for one field item.
     *
     * @param EntityInterface $entity
     * @return string
     *   The textual output generated.
     */
    protected function viewValue(EntityInterface $entity) {
        global $base_url;

        $label = $entity->label();
        $id = $entity->id();

        $urlView = $base_url . '/' . $this->getSetting('view_path') . '/' . $id;
        $url = Url::fromUri($urlView);
        $link = Link::fromTextAndUrl($this->t('@NombreActor', ['@NombreActor' => $label]), $url);

        return $link->toString();
    }

}
