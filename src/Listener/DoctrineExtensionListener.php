<?php


namespace App\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class DoctrineExtensionListener implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function onLateKernelRequest(GetResponseEvent $event)
    {
    }
    public function onConsoleCommand()
    {
    }
    public function onKernelRequest(GetResponseEvent $event)
    {
        $ip = $event->getRequest()->getClientIp();
        if (null !== $ip) {
            $ipTraceable = $this->container->get('gedmo.listener.iptraceable');
            $ipTraceable->setIpValue($ip);
        }
    }
}