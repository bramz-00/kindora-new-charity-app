// stores/goodStore.ts
import { create } from 'zustand';
import type { Good } from '@/types/admin';
import { createGood, deleteGood, fetchGoods, updateGood } from '@/services/good';

interface GoodState {
  goods: Good[];
  loading: boolean;

  setGoods: (goods: Good[]) => void;
  setLoading: (loading: boolean) => void;

  // Les actions ne sont que des appels externes maintenant
  fetchGoods: () => Promise<void>;
  createGood: (data: Partial<Good>) => Promise<void>;
  updateGood: (data: Partial<Good>) => Promise<void>;
  deleteGood: (id: number) => Promise<void>;
}

export const useGoodStore = create<GoodState>((set) => ({
  goods: [],
  loading: false,

  setGoods: (goods) => set({ goods }),
  setLoading: (loading) => set({ loading }),

  fetchGoods: fetchGoods,
  createGood: createGood,
  updateGood:updateGood,
  deleteGood: deleteGood,
}));
