<?php

namespace Drupal\ejemplo_modulos\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
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
    public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder, RendererInterface $renderer) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        $this->formBuilder = $formBuilder;
        $this->renderer = $renderer;

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
        return new static($configuration, $plugin_id, $plugin_definition, $container->get('form_builder'), $container->get('renderer'));
    }

    /**
     * @return array
     */
    public function build() {
        $build = [];

        $form = $this->formBuilder->getForm('Drupal\ejemplo_modulos\Form\SubscribeForm');
        $build['subscribe'] = $form;

        return $build;
    }
}
