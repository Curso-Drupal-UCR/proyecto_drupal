<?php

namespace Drupal\bloques_de_prueba\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'NombreDeUsuarioBlock' block.
 *
 * @Block(
 *  id = "nombre_de_usuario_block",
 *  admin_label = @Translation("Nombre de usuario block"),
 * )
 */
class NombreDeUsuarioBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        $idUsuario = \Drupal::currentUser()->id();
        //    ksm($idUsuario);

        $account = \Drupal\user\Entity\User::load($idUsuario);
        //      dsm($account);

        $nombreUsuario = $account->get('name')->value;
        // dsm($nombreUsuario);

        $build['nombre_de_usuario_block'] = [
            '#markup' => $this->t('Hola compa @admin, Cómo andas?', [
                '@admin' => $nombreUsuario
            ])
        ];

        return $build;
    }

}












