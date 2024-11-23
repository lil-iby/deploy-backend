<?php

namespace App\Http\Controllers\Auth;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Gérer l'authentification de l'utilisateur et l'attribution du token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation des entrées
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'mot_de_passe' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        // Tentative de connexion
        if (Auth::attempt(['email' => $request->email, 'mot_de_passe' => $request->mot_de_passe])) {
            $utilisateur = Auth::user();

            // Créer un token unique pour chaque utilisateur et l'associer à son rôle
            $token = $utilisateur->createToken('LaravelAppToken', [$utilisateur->role])->plainTextToken;

            return response()->json([
                'message' => 'Utilisateur connecté avec succès',
                'token' => $token,
                'role' => $utilisateur->role,
            ]);
        } else {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }
    }

    /**
     * Déconnecter l'utilisateur en supprimant son token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Utilisateur déconnecté avec succès']);
    }
}
