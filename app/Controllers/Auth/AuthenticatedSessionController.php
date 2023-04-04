<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Http\RedirectResponse;
use CodeIgniter\View\RendererInterface;
use Fluent\Auth\Facades\Auth;
use Fluent\Auth\Facades\RateLimiter;
use Fluent\Auth\Helpers\Str;
use Fluent\Auth\Entities\User;

use function func_get_args;
use function is_array;
use function is_bool;
use function strtolower;
use function trim;
use Google_Client;

class AuthenticatedSessionController extends BaseController
{
    /**
     * Max attempt login throttle.
     *
     * @var int
     */
    const MAX_ATTEMPT = 5;

    /**
     * Decay in second if failed attempt.
     *
     * @var int
     */
    const DECAY_SECOND = 60;

    /**
     * Display the login view.
     *
     * @return RendererInterface
     */
    public function new()
    {
        return $this->render('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        try {
            $credentials = [];
            $request = json_decode(json_encode((object) $this->request->getPost()), true);
            if (isset($request['credential'])) {
                // Populate request to object.
                $client = new Google_Client(['client_id' => "177019467763-3lmq8p5en6eanh15boil0n14te8o0ntv.apps.googleusercontent.com"]);
                $payload = $client->verifyIdToken($request['credential']);
                $userModel = new UserModel();
                $user = $userModel->where('email', $payload['email'])->first();
                if ($user == null) {
                    $userModel->insert(new User([
                        'username' => $payload['name'],
                        'email'    => $payload['email'],
                        'password' => $payload['sub'],
                    ]));
                }

                // Credentials for attempt login.
                $credentials = ['email' => $payload['email'], 'password' => $payload['sub']];
            } else {
                // Credentials for attempt login.
                $credentials = ['email' => $request['email'], 'password' => $request['password']];
            }

            // Credential if remember.
            $remember = true;

            if (!Auth::attempt($credentials, $remember)) {

                return redirect()->back()->withInput()->with('error', lang('Auth.failed'));
            }

            // Finnaly we're success login.
            return redirect('/')->withCookies();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @return RedirectResponse
     */
    public function delete()
    {
        $role = Auth::user()->role;
        Auth::logout();
        if ($role == 'user') {
            return redirect('/')->withCookies();
        } else {
            return redirect('admin')->withCookies();
        }
    }
}
