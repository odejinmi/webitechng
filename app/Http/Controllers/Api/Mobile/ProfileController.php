<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Constants\Status;
use App\Lib\GoogleAuthenticator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                'profile' => $this->profileData($request->user()->fresh()),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'nullable|string|max:50',
            'lastname' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'dob' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:30',
            'country' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:7000000',
        ]);

        $user = $request->user();
        foreach (['firstname', 'lastname', 'gender', 'dob'] as $field) {
            if (array_key_exists($field, $validated)) {
                $user->{$field} = $validated[$field];
            }
        }

        $addressFields = ['address', 'state', 'city', 'zip', 'country'];
        if (array_intersect($addressFields, array_keys($validated))) {
            $address = (array) ($user->address ?? []);
            foreach ($addressFields as $field) {
                if (array_key_exists($field, $validated)) {
                    $address[$field] = $validated[$field];
                }
            }
            $user->address = $address;
        }

        if (!empty($validated['image'])) {
            $user->image = $this->storeAvatar($user, $validated['image']);
        }

        $user->saveOrFail();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Profile updated successfully.',
            'data' => [
                'profile' => $this->profileData($user->fresh()),
            ],
        ]);
    }

    public function updatePassword(Request $request)
    {
        $passwordRule = Password::min(8);
        if (gs()->secure_password) {
            $passwordRule = $passwordRule->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', $passwordRule],
        ]);

        $user = $request->user();
        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->saveOrFail();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Login password updated successfully.',
        ]);
    }

    public function twoFactorSetup(Request $request)
    {
        $user = $request->user();
        if ((int) $user->ts === Status::ENABLE) {
            throw ValidationException::withMessages([
                'two_factor' => ['Two-factor authentication is already enabled.'],
            ]);
        }

        $secret = (new GoogleAuthenticator())->createSecret();
        $issuer = (string) gs()->site_name;
        $account = $user->username ?: $user->email;
        $label = rawurlencode($issuer . ':' . $account);
        $otpauthUri = 'otpauth://totp/' . $label
            . '?secret=' . rawurlencode($secret)
            . '&issuer=' . rawurlencode($issuer);

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                'secret' => $secret,
                'otpauth_uri' => $otpauthUri,
            ],
        ]);
    }

    public function enableTwoFactor(Request $request)
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'regex:/^[A-Z2-7]{16,128}$/'],
            'code' => ['required', 'digits:6'],
        ]);

        $user = $request->user();
        if ((int) $user->ts === Status::ENABLE) {
            throw ValidationException::withMessages([
                'two_factor' => ['Two-factor authentication is already enabled.'],
            ]);
        }

        if (!verifyG2fa($user, $validated['code'], $validated['key'])) {
            throw ValidationException::withMessages([
                'code' => ['The authenticator code is invalid.'],
            ]);
        }

        $user->tsc = $validated['key'];
        $user->ts = Status::ENABLE;
        $user->saveOrFail();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Two-factor authentication enabled successfully.',
        ]);
    }

    public function disableTwoFactor(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $request->user();
        if ((int) $user->ts !== Status::ENABLE || empty($user->tsc)) {
            throw ValidationException::withMessages([
                'two_factor' => ['Two-factor authentication is not enabled.'],
            ]);
        }

        if (!verifyG2fa($user, $validated['code'])) {
            throw ValidationException::withMessages([
                'code' => ['The authenticator code is invalid.'],
            ]);
        }

        $user->tsc = null;
        $user->ts = Status::DISABLE;
        $user->saveOrFail();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Two-factor authentication disabled successfully.',
        ]);
    }

    private function profileData(User $user): array
    {
        return [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'fullname' => trim($user->firstname . ' ' . $user->lastname),
            'username' => $user->username,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'mobile_code' => $user->mobile_code,
            'country_code' => $user->country_code,
            'gender' => $user->gender,
            'dob' => $user->dob,
            'address' => $user->address,
            'image' => $user->image,
            'image_url' => getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')),
            'email_verified' => (bool) $user->ev,
            'mobile_verified' => (bool) $user->sv,
            'two_factor_enabled' => (bool) $user->ts,
        ];
    }

    private function storeAvatar(User $user, string $dataUri): string
    {
        if (!preg_match('/^data:image\/(jpeg|jpg|png);base64,(.+)$/s', $dataUri, $matches)) {
            throw ValidationException::withMessages([
                'image' => ['The image must be a base64 encoded JPEG or PNG data URI.'],
            ]);
        }

        $contents = base64_decode($matches[2], true);
        if ($contents === false || strlen($contents) > 5 * 1024 * 1024) {
            throw ValidationException::withMessages([
                'image' => ['The image is invalid or larger than 5 MB.'],
            ]);
        }

        $imageInfo = @getimagesizefromstring($contents);
        if (!$imageInfo || !in_array($imageInfo['mime'], ['image/jpeg', 'image/png'], true)) {
            throw ValidationException::withMessages([
                'image' => ['The image content must be a valid JPEG or PNG.'],
            ]);
        }

        $extension = $imageInfo['mime'] === 'image/png' ? 'png' : 'jpg';
        $temporaryPath = tempnam(sys_get_temp_dir(), 'profile_');
        if ($temporaryPath === false || file_put_contents($temporaryPath, $contents) === false) {
            throw ValidationException::withMessages([
                'image' => ['The image could not be processed.'],
            ]);
        }

        try {
            $file = new UploadedFile(
                $temporaryPath,
                'profile.' . $extension,
                $imageInfo['mime'],
                null,
                true
            );

            return fileUploader(
                $file,
                getFilePath('userProfile'),
                getFileSize('userProfile'),
                $user->image
            );
        } finally {
            @unlink($temporaryPath);
        }
    }
}
