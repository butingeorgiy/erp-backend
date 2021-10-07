<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\RegisterPhysicRecruiterRequest;
use App\Jobs\EmailVerificationJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RecruiterController extends Controller
{
    /**
     * Register account for physic recruiter.
     *
     * @param RegisterPhysicRecruiterRequest $request
     * @return JsonResponse
     */
    public function registerPhysicRecruiter(RegisterPhysicRecruiterRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request, &$user) {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => User::hashPassword($request->input('password')),
                'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID,
                'status_id' => User::$NOT_VERIFIED_STATUS_ID
            ]);

            // TODO: add saving of profile photo

            # Attach user's data.
            $user->physicalRecruiterData()->create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'city_id' => $request->input('city_id')
            ]);
        });

        EmailVerificationJob::dispatch($user)->delay(now()->addSeconds(5));

        return response()->json([
            'success' => true
        ], options: JSON_UNESCAPED_UNICODE);
    }
}
