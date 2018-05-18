<?php

namespace Drupal\drupal_demos\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'rgbcolor_input' field type.
 *
 * @FieldType(
 *   id = "rgbcolor_input",
 *   label = @Translation("Rgbcolor input"),
 *   description = @Translation("Campo de color"),
 *   default_widget = "rgbwidget_type",
 *   default_formatter = "rgbcolor_formatter_type"
 * )
 */
class RGBColorInput extends FieldItemBase {

    /**
     * Inside this method we defines all the fields (properties) that our
     * custom field type will have.
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

        $properties['value'] = DataDefinition::create('string')->setLabel(t('Hex value'));

        return $properties;
    }

    /**
     * Field Type schema definition
     * Inside this method we defines the database schema used to store data for
     * our field type.
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        return [
            'columns' => [
                'value' => [
                    'type' => 'text',
                    'size' => 'tiny',
                    'not null' => FALSE,
                ],
            ],
        ];
    }

    /**
     * Inside this method we defines all the fields (properties) that our
     * custom field type will have.
     */
    public function isEmpty() {
        $value = $this->get('value')->getValue();
        return $value === NULL || $value === '';
    }

}
