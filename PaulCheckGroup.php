<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 27.02.18
 * Time: 16:45
 */

namespace PaulCheckGroup;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class PaulCheckGroup extends Plugin
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('paul_check_group.plugin_dir', $this->getPath());
        parent::build($container);
    }

}