<?php

namespace Drupal\drupal_itm_demos\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SubscribeForm.
 */
class SubscribeForm extends FormBase {


    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'subscribe_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['email'] = [
            '#type' => 'email',
            '#required' => TRUE,
            '#title' => $this->t('Email'),
            '#description' => $this->t('Enter your email'),
            '#weight' => '0',
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Subscribe me'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $email = $form_state->getValue('email');
        drupal_set_message($this->t('Entered email was @email', ['@email' => $email]));
    }

}
