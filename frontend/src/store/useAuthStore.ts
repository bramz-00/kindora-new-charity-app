import { create } from 'zustand';

interface AuthState {
  user: User | null;
  setUser: (user: User | null) => void;
}



export const useAuthStore = create<AuthState>((set) => ({
  user: null,
  setUser: (user) => set({ user }),
}))


 interface User {
  id: number
  first_name: string
  last_name: string
  full_name: string
  phone: string
  birth_date: string | null
  is_active: boolean
  email_verified: boolean | number
  email: string
  email_verified_at: string | null
  created_at: string
  joined_date: string
  token: string
}
