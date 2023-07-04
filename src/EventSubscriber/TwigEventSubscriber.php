<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\EventSubscriber;

use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookieCategoryRepository;
use Prolyfix\SymfonyCookieNotificationBundle\Storage\CookieSessionStorage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
use Symfony\Component\HttpFoundation\RequestStack;
use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookieNotificationRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    
    private $twig;
    private $container;
    private $cookieNotificationsRepository;
    private $cookieCategoryRepository;
    private $params;

    public function __construct(
        Environment $twig, 
        RequestStack $container, 
        CookieNotificationRepository $cookieNotificationsRepository,
        CookieCategoryRepository $cookieCategoryRepository,
        ParameterBagInterface $params
    )
    {
        $this->twig = $twig;
        $this->container = $container;
        $this->cookieNotificationsRepository = $cookieNotificationsRepository;
        $this->cookieCategoryRepository = $cookieCategoryRepository;
        $this->params = $params;
    }
    public function onKernelController(ControllerEvent $event)
    {
       $cookies = $this->container->getCurrentRequest()->cookies;
       $cookiRulesFinal = [];
       if($cookies->has(CookieSessionStorage::COOKIE_KEY_NAME)){
           $cookieId = $cookies->get(CookieSessionStorage::COOKIE_KEY_NAME);
           $cookiesRules = $this->cookieNotificationsRepository->findBy(['cookieConsentKey' => $cookieId]);
           foreach($cookiesRules as $cr){
                $cookiRulesFinal[$cr->getCategory()->getName()] = ['accepted' => $cr->isCookieValidation(), 'category' => $cr->getCategory()];
            }
       }
       $cookieCategories = $this->cookieCategoryRepository->findAll();
       
       $this->twig->addGlobal('cookieRules', $cookiRulesFinal);
       $this->twig->addGlobal('cookieCategories', $cookieCategories);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}