<?php
namespace Prolyfix\SymfonyCookieNotificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder():TreeBuilder
    {
        $treeBuilder = new TreeBuilder('prolyfix_symfony_cookie_notification');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode  
            ->children()
                ->booleanNode('strict')->defaultTrue()->end()
                ->booleanNode('showPartner')->defaultFalse()->end()
                ->scalarNode('retention')->defaultValue('+1 year')->end();
        return $treeBuilder;
    }
}
