<?php

namespace Drupal\bloques_de_prueba\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'InfoCustomBlock' block.
 *
 * @Block(
 *  id = "info_custom_block",
 *  admin_label = @Translation("El usuario agrega el contenido"),
 * )
 */
class InfoCustomBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [
                'content_block' => 'Agregue algo acá',
                'color' => '',
                'rellenar' => FALSE
            ] + parent::defaultConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {

        $form['content_block'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Ingrese el contenido'),
            '#description' => $this->t('La info que quiere que se muestre'),
            '#default_value' => $this->configuration['content_block'],
            '#weight' => '0'
        ];

        $form['color'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Ingrese el color en HEX'),
            '#default_value' => $this->configuration['color'],
            '#size' => 7,
            '#maxlength' => 7,
            '#weight' => '0'
        ];

        $form['rellenar'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Rellenar'),
            '#default_value' => $this->configuration['rellenar'],
            '#weight' => '0'
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {

        $this->configuration['content_block'] = $form_state->getValue('content_block');
        $this->configuration['color'] = $form_state->getValue('color');
        $this->configuration['rellenar'] = $form_state->getValue('rellenar');

    }

    public function blockValidate($form, FormStateInterface $form_state) {
        parent::blockValidate($form, $form_state);

        $color = $form_state->getValue('color');
        // #ffffff #FFFFFF

        if(strlen($color) === 0 ){
            $form_state->setErrorByName('color', $this->t('No se han ingresado datos'));
        }

        //  #ffffff

        if(!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($color))){
            $form_state->setErrorByName('color', $this->t('Debe ingresar un valor HEX valido(#ffffff)'));
        }
    }


    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        $color = $this->configuration['color'];

        $rellenar = $this->configuration['rellenar'];
        $cssColor = $rellenar ? "background: $color" : "color: $color";

        $build['info_custom_block_content_block'] = [
            '#type' => 'inline_template',
            '#template' => '<p>{{ contenido }}</p>',
            '#context' => [
                'contenido' => $this->configuration['content_block'],
            ]
        ];

        $build['info_custom_block_color'] = [
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => $this->t('Este es el color: @color',
                ['@color' => $color]),
            '#attributes' => [
                'style' => "color: $color"
            ]
        ];

        $build['info_custom_block_color_check'] = [
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => $this->t('Este es el otro color: @color',
                ['@color' => $color]),
            '#attributes' => [
                'style' => $cssColor
            ]
        ];

        return $build;
    }

}
