<?php namespace AppBundle\Controller\Api;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Restaurant;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginController
 * @package AppBundle\Controller\Api
 * @Route("/fs")
 */
class LoginController extends BaseController
{
    /**
     * Authentication via username and password for the Restaurant
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Authentication via api for the restaurant",
     *  filters={
     *      {"name"="_username", "dataType"="string"},
     *      {"name"="_password", "dataType"="string"}
     *  }
     * )
     * @Route("/authenticate", name="authenticate")
     * @Method({"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = (object) $request->request->all();

        #TODO: implement the password hash system
        $restaurant = $em->getRepository(Restaurant::class)->findOneBy([
            'username' => trim($data->_username),
            'password' => trim($data->_password)
        ]);

        if (!$restaurant)
            return $this->createBadResponse(['message' => 'Invalid Credentials']);

        return $this->createApiResponse([
            '_token' => $restaurant->getToken()
        ]);
    }

}