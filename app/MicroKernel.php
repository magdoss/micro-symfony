<?php

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Routing\RouteCollectionBuilder;

class MicroKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles() {

        return [
            new FrameworkBundle()
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes) {
        $routes->add('/hello/symfony/{version}', 'kernel:helloSymfony');
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework', [
            'secret' => 'micro-symf',
        ]);
    }

    public function helloSymfony($version)
    {
        return new Response('Hi Symfony version '.$version);
    }

}