<?php

namespace Drupal\ejemplo_modulos\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigurationForm.
 */
class ConfigurationForm extends ConfigFormBase {

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames() {
        return [
            'ejemplo_modulos.configuration'
        ];
    }

    /**
     * Get the form_id
     * @return string
     */
    public function getFormId() {
        return 'configuration_form';
    }

    /**
     * Build the form structure
     *
     * @param array $form
     * @param FormStateInterface $form_state
     * @return array
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config('ejemplo_modulos.configuration');

        $form['color_favorito'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Color favorito'),
            '#description' => $this->t('Ingrese su color favorito'),
            '#default_value' => $config->get('color_favorito'),
            '#maxlength' => 64,
            '#size' => 64,
            '#weight' => '0',
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        drupal_set_message($this->t('Se almaceno el color: @color', ['@color' => $form_state->getValue('color_favorito')]));

        $this->config('ejemplo_modulos.configuration')->set('color_favorito', $form_state->getValue('color_favorito'))->save();
    }
}
