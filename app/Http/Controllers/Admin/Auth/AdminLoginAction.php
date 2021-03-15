<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\SessionEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Backoffice\AdminLogin\UseCase as AdminLoginUseCase;
use App\UseCases\Backoffice\AdminLogin\Request as UseCaseRequest;

class AdminLoginAction extends Controller
{
    /**
     * @var AdminLoginUseCase
     */
    private $useCase;

    public function __construct(AdminLoginUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        try {
            $useCaseRequest = new UseCaseRequest();
            $useCaseRequest->setEmail($request->post('email'));
            $useCaseRequest->setPassword($request->post('password'));

            $this->useCase->handle($useCaseRequest);

            return redirect()
                ->route('admin.home')
                ->with(SessionEnum::SUCCESS, __('auth.login_success'));

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with(SessionEnum::FAILED, __('auth.login_failed'));
        }

    }
}
