<?php

namespace Drupal\demo_modulo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SubscriptionForm.
 */
class SubscriptionForm extends FormBase {


    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'subscription_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['correo_electronico'] = [
            '#type' => 'email',
            '#title' => $this->t('Correo electronico'),
            '#description' => $this->t('Ingresa tu correo electronico'),
            '#default_value' => 'example@example.example',
            '#weight' => '0',
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
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
//        $email = $form_state->getValue('correo_electronico');

        $email = $form_state->getValue('correo_electronico');
//        drupal_set_message($this->t('El email registrado es: @email', ['@email' => $email]));

        drupal_set_message($this->t("@email subscrito", ['@email' => $email]));
    }
}
