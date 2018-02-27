<?php

namespace PaulCheckGroup\Subscriber;

use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Frontend implements SubscriberInterface
{

    /** @var  ContainerInterface */
    private $container;

    /**
     * Frontend contructor.
     * @param ContainerInterface $container
     **/
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch'
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        $controller = $args->getSubject();
        $view = $controller->View();
        $view->addTemplateDir($this->container->getParameter('paul_check_group.plugin_dir') . '/Resources/Views');
        $config = $this->container->get('shopware.plugin.config_reader')->getByPluginName('PaulCheckGroup');

        // get plugin config
        $active = $config['active'];

        if($active) {
            $sCustomerUserGroup = Shopware()->Session()->sUserGroup;
            $view->assign('paulCustomerGroup', $sCustomerUserGroup);
        }
    }

}