// stores/jackpotStore.ts
import { create } from 'zustand';
import type { Jackpot } from '@/types/admin';
import { createJackpot, deleteJackpot, fetchJackpots, updateJackpot } from '@/services/jackpot';

interface JackpotState {
  jackpots: Jackpot[];
  loading: boolean;

  setJackpots: (jackpots: Jackpot[]) => void;
  setLoading: (loading: boolean) => void;

  // Les actions ne sont que des appels externes maintenant
  fetchJackpots: () => Promise<void>;
  createJackpot: (data: Partial<Jackpot>) => Promise<void>;
  updateJackpot: (data: Partial<Jackpot>) => Promise<void>;
  deleteJackpot: (id: number) => Promise<void>;
}

export const useJackpotStore = create<JackpotState>((set) => ({
  jackpots: [],
  loading: false,

  setJackpots: (jackpots) => set({ jackpots }),
  setLoading: (loading) => set({ loading }),

  fetchJackpots: fetchJackpots,
  createJackpot: createJackpot,
  updateJackpot:updateJackpot,
  deleteJackpot: deleteJackpot,
}));
