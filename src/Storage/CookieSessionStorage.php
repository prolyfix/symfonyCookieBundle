<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Storage;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieNotification;
use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookieNotificationRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class CartSessionStorage
 * @package Prolyfix\SymfonyCookieNotificationBundle\Storage
 */
class CookieSessionStorage
{
    /**
     * The session storage.
     *
     * @var SessionInterface
     */
    private $session;

    /**
     * @var CookieNotificationRepository
     */
    private $cookieNotificationRepository;

    /**
     * @var string
     */
    const COOKIE_KEY_NAME = 'cookie_consent_id';

    /**
     * CartSessionStorage constructor.
     *
     * @param SessionInterface $session
     * @param CookieNotificationRepository $commandeRepository
     */
    public function __construct(SessionInterface $session, CookieNotificationRepository $cookieConsentRepository) 
    {
        $this->session = $session;
        $this->cookieNotificationRepository = $cookieConsentRepository;
    }

    /**
     * Gets the cart in session.
     *
     * @return Order|null
     */
    public function getCookieConsent(): ?CookieNotification
    {
        return $this->cookieNotificationRepository->getActualCookie(
            $this->getCookieConsentKey(),
        );
    }

    /**
     * Reset the cart (for instance after a buying process)
     */
    public function resetCommande():void
    {
        $this->session->remove(self::COOKIE_KEY_NAME);
    } 

    /**
     * Sets the cart in session.
     *
     * @param Order $cart
     */
    public function setCookieConsentKey(CookieNotification $cookieConsent): void
    {
        $this->session->set(self::COOKIE_KEY_NAME, $cookieConsent->getCookieConsentKey());
    }

    /**
     * Returns the cart id.
     *
     * @return int|null
     */
    private function getCookieConsentKey(): ?int
    {
        
        return $this->session->get(self::COOKIE_KEY_NAME);
    }
}