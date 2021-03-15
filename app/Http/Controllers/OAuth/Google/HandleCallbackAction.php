<?php


namespace App\Http\Controllers\OAuth\Google;

use App\Enums\SessionEnum;
use App\Http\Controllers\Controller;
use App\UseCases\UserLogin\UseCase as UserLoginUseCase;
use Illuminate\Http\Request;
use App\UseCases\UserLogin\Request as UseCaseRequest;

class HandleCallbackAction extends Controller
{
    private $googleClient;
    private $userLoginUseCase;

    public function __construct(
        \Google_Client $client,
        UserLoginUseCase $useCase
    )
    {
        $this->googleClient = $client;
        $this->userLoginUseCase = $useCase;
    }

    public function __invoke(Request $request)
    {
        try {
            $code = $request->query('code');

            $accessToken = $this->googleClient->fetchAccessTokenWithAuthCode($code);
            $this->googleClient->setAccessToken($accessToken);

            $service = new \Google_Service_Oauth2($this->googleClient);

            $user = $service->userinfo->get();

            $email = $user->getEmail();
            $name = $user->getName();

            $useCaseRequest = new UseCaseRequest();
            $useCaseRequest->setEmail($email);
            $useCaseRequest->setName($name);

            $this->userLoginUseCase
                ->handle($useCaseRequest);

           return redirect()
                ->route('marketplace.index')
                ->with(SessionEnum::SUCCESS, __('auth.login_success'));

        } catch (\Exception $e) {

            return redirect()
                ->route('marketplace.index')
                ->with(SessionEnum::FAILED, __('auth.login_failed'));
        }

    }
}
