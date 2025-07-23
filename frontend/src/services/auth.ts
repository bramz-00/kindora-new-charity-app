import api from "@/api/client"
import type { User } from "@/types/admin"


/**
 * Interface des données pour login
 */
export interface LoginCredentials {
  email: string
  password: string
}

/**
 * Interface des données pour l'enregistrement
 */
export interface RegisterPayload {
  first_name: string
  last_name: string
  phone: string
  email: string
  password: string
  password_confirmation: string
}

/**
 * Récupère l'utilisateur connecté depuis les cookies HTTP-only
 */
export const getUser = async () => {
  const response = await api.get('/api/auth/user')
  return response.data.data 
}

/**
 * Authentifie un utilisateur (envoie l'email + mot de passe)
 * Laravel envoie le cookie HTTP-only automatiquement
 */
export const login = async (credentials: LoginCredentials): Promise<void> => {
  await api.get('/sanctum/csrf-cookie') // obligatoire avant login avec Sanctum
  await api.post('/api/auth/login', credentials)
    await getUser() // Charge l'utilisateur connecté après le login
}

/**
 * Enregistre un utilisateur
 * Laravel envoie le cookie HTTP-only automatiquement
 */
export const register = async (payload: RegisterPayload): Promise<void> => {
  await api.get('/sanctum/csrf-cookie') // obligatoire aussi avant register avec Sanctum
  await api.post('/api/auth/register', payload)
}

/**
 * Déconnecte l'utilisateur en supprimant le cookie HTTP-only côté backend
 */
export const logout = async (): Promise<void> => {
  await api.post('/api/auth/logout')
}
