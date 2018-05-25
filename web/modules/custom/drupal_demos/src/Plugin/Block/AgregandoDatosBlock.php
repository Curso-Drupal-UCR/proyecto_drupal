<?php

namespace Drupal\drupal_demos\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'AgregandoDatosBlock' block.
 *
 * @Block(
 *  id = "agregando_datos_block",
 *  admin_label = @Translation("Agregando datos block"),
 * )
 */
class AgregandoDatosBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [
                'block_content' => 'Este es el contenido del bloque',
                'color_block' => '',
                'color_texto' => FALSE
            ] + parent::defaultConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form['block_content'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Ingrese el contenido del bloque'),
            '#description' => $this->t('Ingrese el contenido del bloque'),
            '#default_value' => $this->configuration['block_content'],
            '#weight' => '0',
        ];

        $form['color_block'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Color block'),
            '#description' => $this->t("Ingrese un color en HEX(#FFFFFF)"),
            '#default_value' => $this->configuration['color_block'],
            '#weight' => '0',
            '#size' => 7,
            '#maxlength' => 7,
        ];

        $form['color_texto'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Usar como color de fondo'),
            '#default_value' => $this->configuration['color_texto'],
        );

        return $form;
    }

    public function blockValidate($form, FormStateInterface $form_state) {
        parent::blockValidate($form, $form_state);

        $color = $form_state->getValue('color_block');

        if (strlen($color) === 0) {
            $form_state->setErrorByName('color_block', $this->t("Tienes que ingresar un color en HEX"));
            return;
        }
        if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($color))) {
            $form_state->setErrorByName('color_block', $this->t("Color debe tener al menos 6 dígitos y un simbolo '#' y ser un dato valido para colores CSS"));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {

        $this->configuration['block_content'] = $form_state->getValue('block_content');
        $this->configuration['color_block'] = $form_state->getValue('color_block');
        $this->configuration['color_texto'] = $form_state->getValue('color_texto');

    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        $color = $this->configuration['color_block'];
        $colorCss = $this->configuration['color_texto'];

        $colorCss = $colorCss ? "background: $color" : "color: $color";

        $build['agregando_datos_block_block_content'] = [
            '#type' => 'inline_template',
            '#template' => '<p style="{{ attr }}" > {{ contenido }}</p>',
            '#context' => [
                'contenido' => $this->configuration['block_content'],
                'color' => $color,
                'attr' => $colorCss
            ]
        ];

        $build['agregando_datos_block_colorcito'] = [
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#value' => $this->t("El color es : @color", ['@color' => $color]),
            '#attributes' => [
                'style' => "color: $color"
            ]
        ];

        $build['agregando_datos_block_colortemplate'] = [
            '#theme' => 'agregar_campos',
            '#parametros' => [
                'contenido' => $this->configuration['block_content'],
                'color' => $color,
                'attr' => $colorCss,
                'colorCss' => $this->configuration['color_texto']
            ]
        ];

        /*
         * '#variables' => [
                'contenido' => $this->configuration['block_content'],
                'color' => $color,
                'attr' => $colorCss,
                'colorCss' => $this->configuration['color_texto']
            ]*/

        return $build;
    }

}
