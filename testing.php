<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

//$templating = $container->get('templating');
//echo $templating->render(
//    ':default:index.html.twig'
//);

$em = $container->get('doctrine')->getManager();

//$bookmark = new \AppBundle\Entity\Bookmark();
//$bookmark->setUrl('http://www.google.com');
//$bookmark->setTitle('Google');
//$bookmark->setDescription('Search Engine');
//
//$em->persist($bookmark);
//$em->flush();


// Notice that calling $em->persist($product) isn't necessary. Recall that this method simply tells Doctrine to manage
// or "watch" the $product object. In this case, since you fetched the $product object from Doctrine,
// it's already managed.
$bookmarkRepository = $em->getRepository('AppBundle:Bookmark');

$bookmark = $bookmarkRepository->findOneBy(['title' => 'Google Inc']);

$bookmark->setTitle('Google');

$em->flush();

//$b2 = new \AppBundle\Entity\Bookmark();
//$b2->setUrl('http://www.symfony.com');
//$b2->setTitle('Symfony');
//$b2->setDescription('Best PHP Framework');
//
//$em->persist($b2);
//$em->flush();