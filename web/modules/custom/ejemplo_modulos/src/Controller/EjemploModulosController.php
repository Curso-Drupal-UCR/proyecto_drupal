<?php

namespace Drupal\ejemplo_modulos\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Zumba\GastonJS\NetworkTraffic\Request;

class EjemploModulosController extends ControllerBase {

    protected $configFactory;

    public function __construct(\Drupal\Core\Config\ConfigFactoryInterface $config_factory) {
        $this->configFactory = $config_factory;
    }

    public static function create(\Symfony\Component\DependencyInjection\ContainerInterface $container) {
        return new static($container->get('config.factory'));
    }

    /**
     * Test Controller
     * @return array
     */
    public function textController() {

        $build = [
            'items' => [
                [
                    '#theme' => 'item_accordion',
                    '#title' => 'Hola bebé',
                    '#description' => 'Como te va?'
                ],
                [
                    '#theme' => 'item_accordion',
                    '#title' => 'Hola bebé',
                    '#description' => 'Como te va?'
                ]
            ],
            '#prefix' => '<div id="accordion">',
            '#suffix' => '</div>',
            '#attached' => [
                'library' => [
                    'core/jquery.ui.accordion',
                    'drupal_itm_demos/demo',
                ],
            ],
        ];

        $items = [
            [
                'title' => $this->t('title 1'),
                'description' => $this->t('description 1'),
            ],
            [
                'title' => $this->t('title 2'),
                'description' => $this->t('description 2'),
            ],
            [
                'title' => $this->t('title 3'),
                'description' => $this->t('description 3'),
            ],
        ];

        foreach ($items as $item) {
            $build['items'][] = [
                '#theme' => 'item_accordion',
                '#title' => $item['title'],
                '#description' => $item['description']
            ];
        }


        return $build;
    }

    public function recibeParametro($parametro = 'Mundo') {

        $build = [
            '#theme' => 'item_accordion',
            '#title' => 'Hola',
            '#description' => $parametro
        ];

        return $build;

    }

    public function content(AccountInterface $user) {
        //        dsm($user);

        $config = $this->configFactory->get('ejemplo_modulos.configuration');

        dsm($config->get('color_favorito'));

        $build = [
            '#theme' => 'item_accordion',
            '#title' => 'Hola',
            '#description' => $this->t('Hola @usuario, ajá tu color es @color bichillo', [
                '@usuario' => $user->getAccountName(),
                '@color' => $config->get('color_favorito')
            ])
        ];

        return $build;
    }

}