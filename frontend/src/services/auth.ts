import api from "@/api/client"
import { useAuthStore } from "@/store/auth"


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
  const user = response.data.data
  useAuthStore.getState().setUser(user) // remplis Zustand

  return user
}

/**
 * Authentifie un utilisateur (envoie l'email + mot de passe)
 * Laravel envoie le cookie HTTP-only automatiquement
 */
export const login = async (credentials: LoginCredentials): Promise<void> => {
  await api.get('/sanctum/csrf-cookie')
  await api.post('/api/auth/login', credentials)
  
  const user = await getUser() // maintenant connecté
  useAuthStore.getState().setUser(user) // remplis Zustand
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
