<?php

namespace Drupal\drupal_demos\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'NombreUsuarioBlock' block.
 *
 * @Block(
 *  id = "nombre_usuario_block",
 *  admin_label = @Translation("Nombre usuario block"),
 * )
 */
class NombreUsuarioBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {

        $idUsuario = \Drupal::currentUser()->id();
//        ksm($idUsuario);

        $account = \Drupal\user\Entity\User::load($idUsuario);
//        ksm($account);

//        $user = $account->get('name');
//        dsm($user);

        $user = $account->get('name')->value;

        $build = [];
        $build['nombre_usuario_block'] = [
            '#markup' => $this->t('Hola de nuevo @usuario', ['@usuario' => $user] )
        ];

        return $build;
    }

}
