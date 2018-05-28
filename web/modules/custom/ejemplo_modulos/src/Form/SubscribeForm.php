<?php

namespace Drupal\ejemplo_modulos\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SubscribeForm.
 */
class SubscribeForm extends FormBase {


    /**
     * @return string
     */
    public function getFormId() {
        return 'subscribe_form';
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     * @return array
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['correo_electronico_subscriptor'] = [
            '#type' => 'email',
            '#title' => $this->t('Correo electrónico'),
            '#description' => $this->t('Ingrese el correo electrónico'),
            '#default_value' => '',
            '#weight' => '0',
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Subscribe me'),
        ];

        return $form;
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);

        $email = $form_state->getValue('correo_electronico_subscriptor');

        if (strlen($email) === 0) {
            $form_state->setErrorByName('correo_electronico_subscriptor', $this->t('Ingrese un correo electrónico'));
        }

        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/iD";
        if (!preg_match($pattern, $email)) {
            $form_state->setErrorByName('correo_electronico_subscriptor', $this->t('Ingrese un correo electrónico válido'));
        }

    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $email = $form_state->getValue('correo_electronico_subscriptor');
        drupal_set_message($this->t('El email registrado es: @email', ['@email' => $email]));

    }

}
