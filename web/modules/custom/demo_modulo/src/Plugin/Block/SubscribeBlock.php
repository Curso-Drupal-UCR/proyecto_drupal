<?php

namespace Drupal\demo_modulo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Locale\CountryManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'SubscribeBlock' block.
 *
 * @Block(
 *  id = "subscribe_block",
 *  admin_label = @Translation("Subscribe block"),
 * )
 */
class SubscribeBlock extends BlockBase implements ContainerFactoryPluginInterface {

    /**
     *
     * Drupal\Core\Form\FormBuilderInterface definition
     *
     * @var FormBuilderInterface
     */
    protected $formBuilder;

    /**
     *
     * Drupal\Core\Render\RendererInterface definition
     *
     * @var RendererInterface
     */
    protected $renderer;

    /**
     * @var CountryManager
     */
    protected  $country_manager;

    /**
     * SubscribeBlock constructor.
     * @param array $configuration
     *  contiene informacion acerca de la instancia del plugin
     * @param $plugin_id
     *  id de la instancia del plugin
     * @param $plugin_definition
     *  definicion de la implementacion
     * @param FormBuilderInterface $formBuilder
     * @param RendererInterface $renderer
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder, RendererInterface $renderer, CountryManager $country_manager) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        $this->formBuilder = $formBuilder;
        $this->renderer = $renderer;
        $this->country_manager = $country_manager;

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
    public static function create(ContainerInterface $container,
                                  array $configuration,
                                  $plugin_id, $plugin_definition) {
        return new static($configuration, $plugin_id, $plugin_definition,
            $container->get('form_builder'), $container->get('renderer'),
            $container->get('country_manager'));
    }

    /**
     * @return array
     */
    public function build() {
        $build = [];

        $form = $this->formBuilder->getForm('Drupal\demo_modulo\Form\SubscriptionForm');
        $build['subscribe'] = $form;


        return $build;
    }
}
