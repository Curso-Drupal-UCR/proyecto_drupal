<?php

namespace Drupal\drupal_demos\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'ContenidoDinamicoBlock' block.
 *
 * @Block(
 *  id = "contenido_dinamico_block",
 *  admin_label = @Translation("Contenido dinamico block"),
 * )
 */
class ContenidoDinamicoBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [
                'ingrese_el_contenido_del_bloque' => 'Hola mundo',
            ] + parent::defaultConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form['ingrese_el_contenido_del_bloque'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Ingrese el contenido del bloque'),
            '#description' => $this->t('Ingrese el contenido del bloque'),
            '#default_value' => $this->configuration['ingrese_el_contenido_del_bloque'],
            '#maxlength' => 64,
            '#size' => 64,
            '#weight' => '0',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['ingrese_el_contenido_del_bloque'] = $form_state->getValue('ingrese_el_contenido_del_bloque');
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];
        $build['contenido_dinamico_block_ingrese_el_contenido_del_bloque']['#markup'] = '<p>' . $this->configuration['ingrese_el_contenido_del_bloque'] . '</p>';

        return $build;
    }

}
