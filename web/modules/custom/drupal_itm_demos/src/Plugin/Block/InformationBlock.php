<?php

namespace Drupal\drupal_itm_demos\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Config\ConfigFactory;

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
     * Drupal\Core\Session\AccountProxyInterface definition.
     *
     * @var \Drupal\Core\Session\AccountProxyInterface
     */
    protected $currentUser;

    /**
     * Drupal\Core\Config\ConfigFactory definition.
     *
     * @var \Drupal\Core\Config\ConfigFactory
     */
    protected $configFactory;

    /**
     * Constructs a new InformationBlock object.
     *
     * @param array $configuration
     *   A configuration array containing information about the plugin instance.
     * @param string $plugin_id
     *   The plugin_id for the plugin instance.
     * @param string $plugin_definition
     *   The plugin implementation definition.
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $current_user, ConfigFactory $config_factory) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->currentUser = $current_user;
        $this->configFactory = $config_factory;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static($configuration, $plugin_id, $plugin_definition, $container->get('current_user'), $container->get('config.factory'));
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        $config = $this->configFactory->get('drupal_itm_demos.configuration');
        $color = $config->get('favorite_color');

        $build['information_block']['#markup'] = $this->t('Hello @name. Your favorite color is @color', [
            '@name' => $this->currentUser->getAccountName(),
            '@color' => $color,
        ]);

        return $build;
    }

}
