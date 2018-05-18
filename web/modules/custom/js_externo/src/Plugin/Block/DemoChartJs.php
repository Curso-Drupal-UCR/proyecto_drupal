<?php

namespace Drupal\js_externo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'DemoChartJs' block.
 *
 * @Block(
 *  id = "demo_chart_js",
 *  admin_label = @Translation("Demo chart js"),
 * )
 */
class DemoChartJs extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];
        $build['chart'] = [
            '#theme' => 'js_externo_demo_charts',
            '#attached' => [
                'library' => [
                    'libraries/chart_js',
                    'js_externo/js_externo.demo_chartjs'
                ],
            ],
        ];
        return $build;
    }
}