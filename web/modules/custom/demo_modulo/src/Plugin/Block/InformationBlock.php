<?php

namespace Drupal\demo_modulo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * Provides a 'InformationBlock' block.
 *
 * @Block(
 *  id = "information_block",
 *  admin_label = @Translation("Information block"),
 * )
 */
class InformationBlock extends BlockBase implements ContainerFactoryPluginInterface{

    /**
     * @var ConfigFactory
     */
    protected $config_factory;

    /**
     * @var AccountProxyInterface
     */
    protected $current_user;

    /**
     * InformationBlock constructor.
     * @param array $configuration
     * @param $plugin_id
     * @param $plugin_definition
     * @param ConfigFactory $config_factory
     * @param AccountProxyInterface $current_user
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition,
                                ConfigFactory $config_factory,
                                AccountProxyInterface $current_user) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        $this->config_factory = $config_factory;
        $this->current_user = $current_user;
    }

    /**
     * @param ContainerInterface $container
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @return static
     */
    public static function create(ContainerInterface $container,
                                  array $configuration, $plugin_id,
                                  $plugin_definition){
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('config.factory'),
            $container->get('current_user')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        $config = $this->config_factory->get('demo_modulo.configuration');

        $color = $config->get('color_favorito');

        $build['information_block'] = [
            '#markup' => $this->t('Hola @usuario, tu color favorito es: @color',
                [
                    '@usuario' => $this->current_user->getAccountName(),
                    '@color' => $color] )
        ];

        return $build;
    }

}
