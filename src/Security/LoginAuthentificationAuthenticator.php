<?php

namespace App\Security;

use Doctrine\ORM\EntityManager;
use http\Client;
use http\Client\Curl\User;
use mysql_xdevapi\Warning;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginAuthentificationAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private readonly UrlGeneratorInterface $urlGenerator)
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
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        $user = $token->getUser();
        $role = $token->getRoleNames();
        $utilisateur=\App\Entity\User::ROLE_CLIENT;


//        $client=$token->getClient();
//        dd($request);
//        /** @var \App\Entity\User $user */
//        $user = $token->getClient();

//        if ($role = ["ADMIN"]) {
//            return new RedirectResponse($this->urlGenerator->generate('admin', []));
//        }

        if ($user->getClient()) {

            return new RedirectResponse($this->urlGenerator->generate('app_client_accueil', ["id" => $user->getClient()?->getId()]));
        }

        if ($user->getArtisan()) {

            return new RedirectResponse($this->urlGenerator->generate('app_artisan_accueil', ["id" => $user->getArtisan()?->getId()]));



        }
        if(!$user) {
            $session = $request->getSession();
            $session->getFlashBag()->add('avertissement', 'Votre profile est en cours de validation');

            return new RedirectResponse($this->urlGenerator->generate('app_home'),);

        }

        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }


}

//
////        $client=$token->getClient();
////        dd($request);
////        /** @var \App\Entity\User $user */
////        $user = $token->getClient();
//
////        if ($role = ["ADMIN"]) {
////            return new RedirectResponse($this->urlGenerator->generate('admin', []));
////        }
//
//if ($utilisateur==="client") {
//
//    return new RedirectResponse($this->urlGenerator->generate('app_client_accueil', ["id" => $user ?->getUser()]));
//}



