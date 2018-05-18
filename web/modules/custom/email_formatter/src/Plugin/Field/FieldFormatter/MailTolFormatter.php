<?php

namespace Drupal\email_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Implementación del Plugin 'email' formatter
 * @FieldFormatter(
 *     id = "mailto_formatter",
 *     label = @Translation("Mail To"),
 *     field_types = {
 *          "string_long",
 *          "email"
 *     },
 *     quickedit = {
 *          "editor" = "plain_text"
 *     }
 * )
 */

class MailTolFormatter extends FormatterBase {

    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($items as $delta => $item){
            $elements[$delta] = [
                '#type' => 'inline_template',
                '#template' => '<a class="enlace" href="mailto:{{ email }}">Send Email</a>',
                '#context' => ['email' => $item->value]
            ];
        }

        return $elements;
    }
}

//https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Render%21Element%21InlineTemplate.php/class/InlineTemplate/8.2.x




// vendor/bin/drupal generate:module --module="modulename" --machine-name="modulename" --module-path="/modules/custom" --description="My Awesome Module" --core="8.x" --package="Custom" --module-file --composer --test --twigtemplate