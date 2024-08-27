<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Clients;
use App\Entity\Users;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        // Initialise la propriété $tokenStorage avec l'injection de dépendance
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        // Définit les événements auxquels ce subscriber doit répondre
        return [
            KernelEvents::VIEW => ['preValidateUser', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function preValidateUser(ViewEvent $event)
    {
        // Récupère l'objet $user depuis le résultat du contrôleur
        $user = $event->getControllerResult();
        // Récupère la méthode HTTP utilisée dans la requête
        $method = $event->getRequest()->getMethod();

        // Vérifie si $user est une instance de la classe User ou si la méthode HTTP est POST
        if ($user instanceof Users || Request::METHOD_POST === $method) {
            // Récupère le token d'authentification actuel
            $token = $this->tokenStorage->getToken();

            // Vérifie si un token existe et si l'utilisateur associé au token est une instance de Client
            if ($token && $token->getUser() instanceof Clients) {
                // Si c'est le cas, récupère le client associé au token
                $client = $token->getUser();
                // Associe le client à l'utilisateur
                $user->setClient($client);
            } else {
                // Retourne une réponse HTTP 403 (Forbidden) si aucun client n'est connecté
                $event->setResponse(new JsonResponse(['message' => 'No clients connected !'], Response::HTTP_FORBIDDEN));
            }
        }
    }
}
