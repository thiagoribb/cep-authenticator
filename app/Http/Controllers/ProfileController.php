<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateAddress(Request $request): View
    {   
        $user = Auth::user();
        $cep = session()->get('cep');

        $request->validate([
            'street' => 'required|string|max:255',
            'neighbourhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
        ]);

        $user->street = $request->input('street');
        $user->neighbourhood = $request->input('neighbourhood');
        $user->city = $request->input('city');
        $user->uf = $request->input('uf');
        $user->cep = $cep;
        $user->save();
        session()->flash('successAddress', 'Endereço alterado com sucesso.');

        return view('dashboard')->with('success', 'Endereço atualizado com sucesso!');
    }

    public function updatePhoto(Request $request): View
    {   
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            
            if ($file->isValid() && in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                $photoBinary = file_get_contents($file->getRealPath());

                $user = Auth::user();
                $user->profile_photo = base64_encode($photoBinary);
                $user->save();
                session()->flash('successPhoto', 'Foto alterada com sucesso.');
            }
        }
        
        return view('dashboard');
    }
}
