<?php

namespace Drupal\demo_modulo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigurationForm.
 */
class ConfigurationForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'demo_modulo.configuration',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'configuration_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config('demo_modulo.configuration');

        $form['color_favorito'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Ingrese su color favorito'),
            '#description' => $this->t('Por favor, digita tu color favorito'),
            '#maxlength' => 64,
            '#size' => 64,
            '#default_value' => $config->get('color_favorito'),
        ];
        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $this->config('demo_modulo.configuration')
            ->set('color_favorito', $form_state->getValue('color_favorito'))
            ->save();
    }

}
