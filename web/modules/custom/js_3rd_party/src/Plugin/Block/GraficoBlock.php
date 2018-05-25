<?php

namespace Drupal\js_3rd_party\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'GraficoBlock' block.
 *
 * @Block(
 *  id = "grafico_block",
 *  admin_label = @Translation("Grafico block"),
 * )
 */
class GraficoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];

    $build['grafico_block']  = [
        '#theme' => 'js_3rd_party',
        '#attached' => [
            'library' => [
                'js_3rd_party/js_3rd_party.demo_chartjs'
            ]
        ]
    ];

    //'libraries/chart_js',

    return $build;
  }

}



















