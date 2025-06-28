<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomExceptionHandlers
{
    /**
     * Enregistrer tous les gestionnaires d'exceptions personnalisés
     *
     * @param \Illuminate\Foundation\Configuration\Exceptions $exceptions
     * @return void
     */
    public static function register(Exceptions $exceptions): void
    {
        // Erreur d'authentification (401)
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Non authentifié.',
                'code' => 401,
            ], 401);
        });

        // Erreurs d'autorisation (403)
        $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas les permissions nécessaires pour effectuer cette action.',
                'code' => 403,
            ], 403);
        });

        $exceptions->renderable(function (AuthorizationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas les permissions nécessaires pour effectuer cette action.',
                'code' => 403,
            ], 403);
        });

        // Erreurs de ressource non trouvée (404)
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Ressource introuvable.',
                'code' => 404,
            ], 404);
        });

        $exceptions->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Ressource introuvable.',
                'code' => 404,
            ], 404);
        });

        // Erreurs de validation (422)
        $exceptions->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Données invalides.',
                'code' => 422,
                'errors' => $e->errors(),
            ], 422);
        });

        // Autres erreurs HTTP
        $exceptions->renderable(function (HttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Erreur HTTP.',
                'code' => $e->getStatusCode(),
            ], $e->getStatusCode());
        });

        // Erreur par défaut (500)
        $exceptions->renderable(function (\Throwable $e, $request) {
            $debug = config('app.debug', false);
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur interne du serveur.',
                'code' => 500,
                'trace' => $debug ? $e->getTrace() : [],
            ], 500);
        });
    }
}