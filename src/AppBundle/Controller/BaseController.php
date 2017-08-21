<?php namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{
    public function createApiResponse($data)
    {
        return new JsonResponse($data);
    }

    public function createBadResponse($data)
    {
        return new JsonResponse($data, JsonResponse::HTTP_BAD_REQUEST);
    }
}