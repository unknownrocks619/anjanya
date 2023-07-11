<?php

namespace App\Http\Requests\Web\User;

use App\Classes\Helpers\WpPassword;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AutheticateRequest extends FormRequest
{
    protected $oldSessionId;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !Auth::guard('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'email' => 'required|email',
            'password'  => 'required'
        ];
    }

    public function autheticateUser()
    {

        $this->oldSessionId = session()->getId();

        $this->ensureIsNotRateLimited();

        if (!Auth::guard('web')->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            $this->checkPasswordAgaistWP();

            if (!Auth::guard('web')->check()) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => __('web/login.login_error'),
                ]);
            }
        }
        RateLimiter::clear($this->throttleKey());
    }

    public function ensureUserProfileComplete()
    {
        $user = Auth::guard('web')->user();

        if ($user->current_step != 'complete') {
            Auth::guard('web')->logout();
            $stepArray  = [
                'step_one'  => 'step_two',
                'step_two'  => 'step_three',
                'step_three' => 'step_four',
                'step_four' => 'step_four',
            ];

            // generate session value
            $manage_session = [
                'current_step' => $stepArray[$user->current_step],
                'account_information'   => [
                    'first_name'    => $user->first_name,
                    'last_name'     => $user->last_name,
                    '_user'         => encrypt($user->getKey())
                ],
                'basic_info'    => [
                    'country'   => $user->country,
                    'roles'     => $user->role,
                    'date_of_birth' => $user->date_of_birth
                ],
                'canva_info'    => [
                    'terms'     => $user->terms,
                    'canva_terms_options'   => $user->getUserCanva ? 'yes' : 'no',
                    'personal_detail'   => ($user->getUserCanva && $user->getUserCanva->accepted_terms && $user->getUserCanva->accepted_terms->personal_detail) ? true : false,
                    'canva_free' => ($user->getUserCanva && $user->getUserCanva->accepted_terms && $user->getUserCanva->accepted_terms->canva_free) ? true : false
                ]
            ];

            session()->put(session()->getId(), $manage_session);
            $url = route('frontend.users.register');
            return $url;
        }

        if ($user->status != User::ALLOW_LOGIN) {
            Auth::guard('web')->logout();
            $error = [
                'message' => "Invalid Username / Password",
                'errors'    => ['email' => ['Invalid Username / Password']]
            ];
            return response($error, 422);
        }
    }


    public function checkPasswordAgaistWP(): void
    {
        // check for user email.
        $user = User::where('email', $this->post('email'))->first();

        if (!$user) {
            return;
        }

        // now check from password.
        $wp_password_hash = new WpPassword(8, true);

        if ($wp_password_hash->CheckPassword($this->string('password'), $user->password)) {
            $user->password = Hash::make($this->post('password'));
            $user->save();
            Auth::guard('web')->login($user, $this->boolean('remember'));
        }
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('web/login.max_attempt', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ], 'en/web'),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return $this->ip();
    }

    public function getCurrentOrderID()
    {
        return $this->oldSessionId;
    }
}
