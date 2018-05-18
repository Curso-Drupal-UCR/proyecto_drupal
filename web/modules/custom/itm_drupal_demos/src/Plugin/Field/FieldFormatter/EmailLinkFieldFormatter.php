<?php

namespace Drupal\itm_drupal_demos\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'email_link_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "email_link_field_formatter",
 *   label = @Translation("Email link field formatter"),
 *   field_types = {
 *     "email"
 *   }
 * )
 */
class EmailLinkFieldFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($items as $delta => $item) {
            $elements[$delta] = [
                '#type' => 'markup',
                '#markup' => $this->viewValue($item)
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
        $url = Url::fromUri('mailto:' . $item->value);
        $link = Link::fromTextAndUrl($this->t('Send Email'), $url);
        return $link->toString();
    }

}


//https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Url.php/class/Url/8.2.x

//https://www.drupal8.ovh/en/tutoriels/154/inline-template-drupal-8-and-twig