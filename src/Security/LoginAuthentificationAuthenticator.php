<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class LoginAuthentificationAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private readonly UrlGeneratorInterface $urlGenerator, private readonly TokenStorageInterface $tokenStorage, private EventDispatcherInterface $eventDispatcher)
    {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // a la connexion ce souvient du dernier lien ou va sur le lien connecté
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            // return new RedirectResponse($targetPath);
        }

        /** @var User $user */
        $user = $token->getUser();
        $userRoles = $token->getRoleNames();

        if (!$user->isVerified()) {
            $logoutEvent = new LogoutEvent($request, $this->tokenStorage->getToken());
            $this->eventDispatcher->dispatch($logoutEvent);

            // Set the token to null
            $this->tokenStorage->setToken(null);

            // Optionally clear the session
            $request->getSession()->invalidate();

            // Redirect to another route
            $response = new RedirectResponse($this->urlGenerator->generate('app_login', ["verify" => false]));
            $response->headers->clearCookie('REMEMBERME');
            $response->send();
            return $response;
        }

        if (in_array(User::ROLE_ADMIN, $userRoles)) {
            return new RedirectResponse($this->urlGenerator->generate('admin', []));
        }
        if (in_array(User::ROLE_CLIENT, $userRoles)) {
            return new RedirectResponse($this->urlGenerator->generate('app_client_accueil', ["id" => $user->getClient()?->getId()]));
        }

        if (in_array(User::ROLE_ARTISAN, $userRoles)) {
            return new RedirectResponse($this->urlGenerator->generate('app_artisan_accueil', ["id" => $user->getArtisan()?->getId()]));
        }

        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }

}





