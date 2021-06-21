<?php

namespace App\Http\Controllers\Auth;

use Auth;

use App\Models\Employee;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\GenericProvider;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as private vendorLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user) {
        $user->generateAPIToken();
    }

    public function showLoginForm(Request $request) {
        $data = [];

        if ($request->session()->get('session_expired', false)) {
            $data['alert'] = 'Your session has expired, please login again.';
        }
        else if ($request->session()->get('sso_failure', false)) {
            $data['alert'] = 'Single sign-on authentication failure, please try again.';
        }

        return view('auth.login', $data);
    }

    public function logout(Request $request) {
        if ($request->user() && $request->user() instanceof User) { 
            // $user->removeAPIToken();
        }
        return $this->vendorLogout($request);
    }

    public function loginAzureAD(Request $request) {
        $oauth_client = $this->prepareOAuthClientForAzure();
        $url = $oauth_client->getAuthorizationUrl();

        // dd($oauth_client->getState());
        $request->session()->put('oauth_state', $oauth_client->getState());

        return redirect()->away($url);
    }

    public function callbackAzureAD(Request $request) {
        // Validate state
        $expected_state = $request->session()->get('oauth_state');
        $request->session()->forget('oauth_state');
        $provided_state = $request->query('state');

        if (!isset($expected_state) || !isset($provided_state) || $expected_state != $provided_state) {
            $request->session()->flash('sso_failure', true);
            return redirect()->route('login');
        }

        $auth_code = $request->query('code');
        if (isset($auth_code)) {
            $oauth_client = $this->prepareOAuthClientForAzure();

            try {
                $access_token = $oauth_client->getAccessToken('authorization_code', [
                    'code' => $auth_code
                ]);
                
                $graph = new Graph();
                $graph->setAccessToken($access_token->getToken());

                $req = $graph->createRequest('GET', '/me');
                $user = $req->setReturnType(Model\User::class)->execute();

                $employee_email = $user->getUserPrincipalName();
                $employee = Employee::where('email', $employee_email)->first();

                if ($employee) {
                    Auth::login($employee->user);
                }
                else {
                    $request->session()->flash('sso_failure', true);
                    return redirect()->route('login');
                }
            }
            catch (\Exception $e) {
                $request->session()->flash('sso_failure', true);
                return redirect()->route('login');
            }
        }

        $request->session()->flash('sso_failure', true);
        return redirect()->route('login');
    }

    private function prepareOAuthClientForAzure() {
        return new GenericProvider([
            'clientId'                => env('OAUTH_AZURE_APP_ID'),
            'clientSecret'            => env('OAUTH_AZURE_APP_PASSWORD'),
            'redirectUri'             => route('sso.azure.callback'),
            'urlAuthorize'            => env('OAUTH_AZURE_AUTHORITY').env('OAUTH_AZURE_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OAUTH_AZURE_AUTHORITY').env('OAUTH_AZURE_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OAUTH_AZURE_SCOPES')
        ]);
    }
}
