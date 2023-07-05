<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Controller;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieCategory;
use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieNotification;
use Prolyfix\SymfonyCookieNotificationBundle\Storage\CookieSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;

class CookieConsentController extends AbstractController
{

    private $strict;
    private $retention;

    public function __construct(bool $strict = false, $retention = '+1 month')
    {
        $this->strict = $strict;
        $this->retention = $retention;
    }

    #[Route('/consent', name: 'app_cookie_consent')]
    public function index(Request $request, EntityManagerInterface $em, ParameterBagInterface $params): Response
    {
        $CategoryNames = $request->get('category');
        $categories = $em->getRepository(CookieCategory::class)->findBy(['name' => $CategoryNames]);
        if(count($categories)==0){
            $categories = $em->getRepository(CookieCategory::class)->findAll();    
        }
        $cookieConsentKey = uniqid();
        $validUntil = (new \DateTimeImmutable())->add(new \DateInterval('P1Y'));
        foreach($categories as $value){
            $cook2 = (new CookieNotification())
                ->setCookieConsentKey($cookieConsentKey)
                ->setCategory($value)
                ->setCreationDate(new \DateTimeImmutable())
                ->setEndValidationDate($validUntil)
                ->setCookieValidation(true);
            $em->persist($cook2);
        }
        $em->flush();            
        $host = explode(":",$request->getHttpHost())[0];
        $cookie = Cookie::create(CookieSessionStorage::COOKIE_KEY_NAME)
            ->withValue($cookieConsentKey)
            ->withExpires(new \DateTime($this->retention))
            ->withDomain($host)
            ->withSecure(true)
            ->withHttpOnly(true);

        $response = new Response();
        $response->headers->setCookie($cookie);
        return $response;
    }

    #[Route('accept', name:'cookie_accept')]
    public function cookieAccept()
    {
        
    }

}
