<?php

namespace Drupal\ejemplo_modulos\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'InformationBlock' block.
 *
 * @Block(
 *  id = "information_block",
 *  admin_label = @Translation("Information block"),
 * )
 */
class InformationBlock extends BlockBase implements ContainerFactoryPluginInterface {

    /**
     * @var AccountProxyInterface
     */
    protected $current_user;

    /**
     * @var ConfigFactory
     */
    protected $configFactory;

    public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $current_user, ConfigFactory $configFactory) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        $this->current_user = $current_user;
        $this->configFactory = $configFactory;
    }

    /**
     * Creates an instance of the plugin.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     *   The container to pull out services used in the plugin.
     * @param array $configuration
     *   A configuration array containing information about the plugin instance.
     * @param string $plugin_id
     *   The plugin ID for the plugin instance.
     * @param mixed $plugin_definition
     *   The plugin implementation definition.
     *
     * @return static
     *   Returns an instance of this plugin.
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static($configuration, $plugin_id, $plugin_definition, $container->get('current_user'), $container->get('config.factory'));
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        $config = $this->configFactory->get('ejemplo_modulos.configuration');
        $color = $config->get('color_favorito');

        $build['information_block'] = [
            '#markup' => $this->t('Hola @usuario, este es tu color: @color', [
                '@usuario' => $this->current_user->getAccountName(),
                '@color' => $color
            ])
        ];

        return $build;
    }
}
