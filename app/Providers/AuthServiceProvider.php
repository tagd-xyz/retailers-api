<?php

namespace App\Providers;

use App\Support\FirebaseToken;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tagd\Core\Models\Actor\Retailer;
use Tagd\Core\Repositories\Interfaces\Users\Users;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \Tagd\Core\Models\Item\Item::class => \App\Policies\Item\Item::class,
        \Tagd\Core\Models\Item\Stock::class => \App\Policies\Item\Stock::class,
        \Tagd\Core\Models\Item\Tagd::class => \App\Policies\Item\Tagd::class,
        \Tagd\Core\Models\Actor\Retailer::class => \App\Policies\Actor\Retailer::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Users $users)
    {
        $this->registerPolicies();

        Auth::viaRequest('firebase', function (Request $request) use ($users) {
            $projectId = config('services.firebase.project_id');
            $tenantId = config('services.firebase.tenant_id');

            $token = $request->bearerToken();

            if ($token) {
                $payload = (new FirebaseToken($token))->verify($projectId);

                if ($tenantId == $payload->firebase->tenant) {
                    $user = $users->createFromFirebaseToken($payload);
                    $users->assertIsActingAs($user, Retailer::class);

                    return $user;
                }
            }

            return null;
        });
    }
}
