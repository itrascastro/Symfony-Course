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

namespace itrascastro\TUserBundle\Controller;


use itrascastro\TUserBundle\Entity\User;
use itrascastro\TUserBundle\Form\Type\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * registerAction
     *
     * Description
     *
     * @Route("/sign-up/", name="tuser_register_signup")
     * @Template()
     *
     * @return array
     */
    public function signUpAction()
    {
        $form = $this->createForm('sign_up');

        return ['form' => $form->createView()];
    }

    /**
     * doSignUpAction
     *
     * Description
     *
     * @Route("/do-signup/", name="tuser_register_dosignup")
     */
    public function doSignUpAction(Request $request)
    {
        $form = $this->createForm('sign_up');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();
            $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('bookmark');
        } else {
            return $this->render('@TUser/Register/signUp.html.twig', ['form' => $form->createView()]);
        }
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
}