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
  loading: true,
  error: null,

  setUser: (user) => set({ user }),

  fetchUser: async () => {
    set({ loading: true, error: null })
    try {
      const user = await getUser()
      set({ user, loading: false })
    } catch (error: any) {
      if (error.response?.status === 401) {
        console.info('Non connecté')
      } else {
        console.error('Erreur fetchUser', error)
      }
      set({ user: null, loading: false })
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
