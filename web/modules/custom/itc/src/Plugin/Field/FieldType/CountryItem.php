<?php

namespace Drupal\itc\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface as StorageDefinition;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *  id = "country",
 *  label = @Translation("Country"),
 *  default_formatter = "country_default_formatter",
 *  default_widget = "country_default_widget"
 * )
 *
 */
class CountryItem extends FieldItemBase {

    public static function propertyDefinitions(StorageDefinition $field_definition) {
        $properties['value'] = DataDefinition::create('string')->setLabel(t('Country'));
        return $properties;
    }

    public static function schema(StorageDefinition $field_definition) {
        return ['columns' => ['value' => ['type' => 'varchar', 'description' => t('Country'), 'length' => 2, 'not null' => FALSE]]];
    }
}