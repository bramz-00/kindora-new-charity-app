import { create } from 'zustand'
import type { User } from '@/types/admin'
import { getUser, logout as logoutService } from '@/services/auth'

interface AuthStore {
  user: User | null
  loading: boolean
  error: string | null

  setUser: (user: User | null) => void
  fetchUser: () => Promise<void>
  logout: () => Promise<void>
}

export const useAuthStore = create<AuthStore>((set) => ({
  user: null,
  loading: false,
  error: null,

  setUser: (user) => set({ user }),

  fetchUser: async () => {
    set({ loading: true, error: null })
    try {
      const user = await getUser()
      set({ user, loading: false })
    } catch (error: any) {
      console.warn('Utilisateur non authentifié')
      set({ user: null, loading: false, error: 'Utilisateur non connecté' })
    }
  },

  logout: async () => {
    set({ loading: true, error: null })
    try {
      await logoutService()
      set({ user: null, loading: false })
    } catch (error: any) {
      set({ error: 'Erreur lors de la déconnexion', loading: false })
    }
  },
}))
