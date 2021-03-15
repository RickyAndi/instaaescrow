<?php

namespace App\Http\Controllers\Marketplace\Auth;

use App\Enums\SessionEnum;
use App\Http\Controllers\Controller;
use App\UseCases\Marketplace\UserLogout\UseCase;

class UserLogoutAction extends Controller
{
    /**
     * @var UseCase
     */
    private $useCase;

    public function __construct(
        UseCase $useCase
    )
    {
        $this->useCase = $useCase;
    }

    public function __invoke()
    {
        try {
            $this->useCase->handle();
        } catch (\Exception $e) {

        }

        return redirect()
            ->route('marketplace.index')
            ->with(SessionEnum::SUCCESS, __('auth.logout_success'));
    }
}
