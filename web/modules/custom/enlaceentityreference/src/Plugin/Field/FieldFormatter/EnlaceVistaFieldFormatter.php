<?php

namespace Drupal\enlaceentityreference\Plugin\Field\FieldFormatter;

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
 * Plugin implementation of the 'enlace_vista_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "enlace_vista_field_formatter",
 *   label = @Translation("Modificar el enlace para que apunte a la vista"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class EnlaceVistaFieldFormatter extends EntityReferenceFormatterBase {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
                'enlace_vista' => ''
            ] + parent::defaultSettings();






        /*
         *
         * $array = [
         *     'BD' => 'BANGLADESH'
         *  ]
         *
         * $miNombre = $array['BD'];
         *
         * */


    }



    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        $formulario = parent::settingsForm($form, $form_state);;

        $formulario['enlace_vista'] = array(
            '#type' => 'textfield',
            '#title' => $this
                ->t('Ingrese el path de la vista'),
            '#default_value' => $this->getSetting('enlace_vista'),
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
        );

        return $formulario;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];

        $link = $this->getSetting('enlace_vista');
        if (!empty($link)){
            $summary[] = $this->t('El path de la vista es: @path', ['@path' => $link]);
        }

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        $items = $this->getEntitiesToView($items, $langcode);

        foreach ($items as $delta => $item) {
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

        // http://localhost/drupal8/web / actores / id

        $urlView = $base_url  . '/' . $this->getSetting('enlace_vista')  . '/' . $id;

        $url = Url::fromUri($urlView);
        // <a href="$url"> $label </a>
        $link = Link::fromTextAndUrl($label, $url);

        return $link->toString();
    }

}
