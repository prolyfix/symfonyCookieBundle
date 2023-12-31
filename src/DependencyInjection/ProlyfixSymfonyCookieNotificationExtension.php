<?php
namespace Prolyfix\SymfonyCookieNotificationBundle\DependencyInjection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class ProlyfixSymfonyCookieNotificationExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition('Prolyfix\SymfonyCookieNotificationBundle\Controller\CookieConsentController');
        $definition->setArgument(0, $config['strict']);
        $definition->setArgument(1, $config['retention']);
        $definition = $container->getDefinition('Prolyfix\SymfonyCookieNotificationBundle\EventSubscriber\TwigEventSubscriber');
        $definition->setArgument(0, $config['showPartner']);

    }
}