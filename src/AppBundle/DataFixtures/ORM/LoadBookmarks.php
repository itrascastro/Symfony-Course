<?php
/**
 * (c) Ismael Trascastro <i.trascastro@gmail.com>
 *
 * @link        http://www.ismaeltrascastro.com
 * @copyright   Copyright (c) Ismael Trascastro. (http://www.ismaeltrascastro.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Bookmark;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBookmarks implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $bookmark1 = new Bookmark();
        $bookmark1->setUrl('http://www.google.com');
        $bookmark1->setTitle('Google Inc');
        $bookmark1->setDescription('Search Engine');
        $manager->persist($bookmark1);

        $bookmark2 = new Bookmark();
        $bookmark2->setUrl('http://reddit.com');
        $bookmark2->setTitle('reddit');
        $bookmark2->setDescription('the front page of the internet');
        $manager->persist($bookmark2);

        $bookmark3 = new Bookmark();
        $bookmark3->setUrl('http://twitter.com');
        $bookmark3->setTitle('Twitter');
        $bookmark3->setDescription('Social Network');
        $manager->persist($bookmark3);

        $bookmark4 = new Bookmark();
        $bookmark4->setUrl('http://www.linkedin.com');
        $bookmark4->setTitle('LinkedIn');
        $bookmark4->setDescription('Connecting the world\'s professionals');
        $manager->persist($bookmark4);

        $manager->flush();
    }
}