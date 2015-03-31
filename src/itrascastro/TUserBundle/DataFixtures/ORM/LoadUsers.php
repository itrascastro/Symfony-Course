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

namespace itrascastro\TUserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use itrascastro\TUserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('bird');
        $user1->setEmail('bird@bostonceltics.com');
        $user1->setPassword($this->encodePassword($user1, '1234'));
        $user1->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('mchale');
        $user2->setEmail('mchale@bostonceltics.com');
        $user2->setPassword($this->encodePassword($user2, '1234'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('parish');
        $user3->setEmail('parish@bostonceltics.com');
        $user3->setPassword($this->encodePassword($user3, '1234'));
        $user3->setIsActive(false);
        $manager->persist($user3);

        $manager->flush();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
}