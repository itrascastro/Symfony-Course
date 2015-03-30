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


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SecurityController extends Controller
{
    /**
     * loginAction
     *
     * Description
     *
     * @Route("/login/", name="tuser_security_login")
     * @Template()
     */
    public function loginAction()
    {
        return [
            // last username entered by the user
            'last_username' => $this->get('security.authentication_utils')->getLastUsername(),
            'error'         => $this->get('security.authentication_utils')->getLastAuthenticationError(),
        ];
    }

    /**
     * loginHoritzontalAction
     *
     * No route needed because it is called from a view
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginHoritzontalAction()
    {
        return $this->render(
            '@TUser/Security/horitzontal-login.html.twig',
            [
                'last_username' => $this->get('security.authentication_utils')->getLastUsername(),
                'error'         => $this->get('security.authentication_utils')->getLastAuthenticationError(),
            ]
        );
    }

    /**
     * loginCheckAction
     *
     * Description
     *
     * @Route("/login_check/", name="tuser_security_loginCheck")
     */
    public function loginCheckAction()
    {

    }

    /**
     * logoutAction
     *
     * Description
     *
     * @Route("/logout/", name="tuser_security_logout")
     */
    public function logoutAction()
    {

    }
}