<?php
namespace App\Actions\Fortify;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\LoginRateLimiter;

class CustomAttemptToAuthenticate
{
    protected $guard;
    protected $limiter;

    public function __construct(StatefulGuard $guard, LoginRateLimiter $limiter)
    {
        $this->guard = $guard;
        $this->limiter = $limiter;
    }

    public function handle($request, $next)
    {
        \Log::info("Inside custom login attempt");
        $login = $request->input('login');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        if (preg_match('/^0\d{9}$/', $login)) {
            $login = '+254' . substr($login, 1);
        }

        if ($this->guard->attempt(['email' => $login, 'password' => $password], $remember)
            || $this->guard->attempt(['phone_number' => $login, 'password' => $password], $remember)) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }

    protected function throwFailedAuthenticationException($request)
    {
        $this->limiter->increment($request);
        throw ValidationException::withMessages([
            Fortify::username() => [trans('auth.failed')],
        ]);
    }
}
