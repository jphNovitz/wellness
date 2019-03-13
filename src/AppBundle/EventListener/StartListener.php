<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Meta;
use AppBundle\Util\MySerializer;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Event;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class StartListener
{

    protected $container;
    protected $serializer;

    public function __construct(ContainerInterface$container, MySerializer $mySerializer)
    {
        $this->container = $container;
        $this->serializer = $mySerializer;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $kernel    = $event->getKernel();
        $request   = $event->getRequest();
        $container = $this->container;

        $filesystem = new Filesystem();
        $root = $container->get('kernel')->getProjectDir();
        $content = file_get_contents($root.'/File/meta.json');

        $meta = $this->serializer->deserialize($content, meta::class, 'json');

        $twig = $container->get('twig');
        $globals = $twig->addGlobal('site_title',$meta->getTitle());
        $globals = $twig->addGlobal('site_description',$meta->getDescription());
    }
}
