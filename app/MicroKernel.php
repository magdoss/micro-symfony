<?php

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use ExampleBundle\ExampleBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

class MicroKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles() {

        $bundles = [
            new FrameworkBundle(),
            new SensioFrameworkExtraBundle(),
            new TwigBundle(),
            new ExampleBundle()
        ];

        return $bundles;
    }

    protected function configureRoutes(RouteCollectionBuilder $routes) {
        /**
         * dynamically adding the defined routes from every bundle
         * e.g. $routes->import(__DIR__.'/../src/<BundleName>/Controller/', '/', 'annotation');
         */
        $routes->import(__DIR__.'/../src/ExampleBundle/Controller/', '/', 'annotation');

    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }

    public function getCacheDir() {
        return dirname(__DIR__).'/app/cache/'.$this->environment;
    }

    public function getLogDir() {
        return dirname(__DIR__).'/app/logs/'.$this->environment;
    }

}