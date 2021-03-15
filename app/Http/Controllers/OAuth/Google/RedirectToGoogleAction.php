<?php

namespace App\Http\Controllers\OAuth\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectToGoogleAction extends Controller
{
    private $googleClient;

    public function __construct(\Google_Client $client)
    {
        $this->googleClient = $client;
    }

    public function __invoke(Request $request)
    {
        $this->googleClient->setPrompt("select_account");
        $this->googleClient->setScopes([
            \Google_Service_Oauth2::USERINFO_EMAIL,
            \Google_Service_Oauth2::USERINFO_PROFILE
        ]);

        $redirectUrl = filter_var($this->googleClient->createAuthUrl(), FILTER_SANITIZE_URL);
        return redirect($redirectUrl);
    }
}
