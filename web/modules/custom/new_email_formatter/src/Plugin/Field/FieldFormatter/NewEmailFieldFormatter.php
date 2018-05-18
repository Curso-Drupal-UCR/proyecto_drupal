<?php

namespace Drupal\new_email_formatter\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'new_email_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "new_email_field_formatter",
 *   label = @Translation("New email field formatter"),
 *   field_types = {
 *     "email"
 *   }
 * )
 */
class NewEmailFieldFormatter extends FormatterBase {


    public static function defaultSettings() {
        return ['path_view' => ''] + parent::defaultSettings();
    }

    public function settingsForm(array $form, FormStateInterface $form_state) {
        $elements = parent::settingsForm($form, $form_state);

        $elements['path_view'] = ['#type' => 'textfield', '#title' => $this->t('View path'), '#size' => '60', '#maxlength' => '20', '#required' => TRUE, '#default_value' => $this->getSetting('path_view'),];

        return $elements;
    }

    public function settingsSummary() {
        $summary = [];

        $settings = $this->getSettings();

        if (!empty($settings['path_view'])) {
            $summary[] = $this->t('View path: @path', ['@path' => $settings['path_view']]);
        }

        return $summary;
    }


    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {

        //        $entity = $items->getEntity();
        //        dpm($this->getSettings('path_view'));

        $elements = [];

        /*
         *
         * [
         *      "email" => "nck.gonse@gmail.com"
         * ]
         *
         * */

        foreach ($items as $delta => $item) {

            $elements[$delta] = ['#type' => 'markup', '#markup' => $this->viewValue($item)];
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

        $entity = $item->getEntity();
        $url = Url::fromUri('mailto:' . $item->value);
        $link = Link::fromTextAndUrl($this->t('Send Email'), $url);
        return $link->toString();


        //<a href="mailto:nick.gonse@gmail.com">Send Email</a>
    }

}

//https://hechoendrupal.gitbooks.io/drupal-console/content/es/commands/generate-plugin-fieldformatter.html
