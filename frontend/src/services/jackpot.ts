// services/jackpot/jackpot.service.ts
import { toast } from 'sonner';
import api from '@/api/client';
import type { Jackpot } from '@/types/admin';
import { useJackpotStore } from '@/store/jackpot';

export const fetchJackpots = async () => {
  const { setLoading, setJackpots } = useJackpotStore.getState();
  setLoading(true);
  try {
    const res = await api.get('/api/admin/jackpot');
    setJackpots(res.data.data);
  } catch (err) {
    toast.error('Failed to fetch jackpots');
  } finally {
    setLoading(false);
  }
};

export const createJackpot = async (data: Partial<Jackpot>) => {
  try {
    const res = await api.post('/api/admin/jackpot', data);
    toast.success(res.data.message);
    await fetchJackpots();
  } catch (err) {
    toast.error('Failed to create jackpot');
  }
};

export const updateJackpot = async (data: Partial<Jackpot>) => {
  try {
    await api.put(`/api/admin/jackpot`, data);
    toast.success('Jackpot updated');
    await fetchJackpots();
  } catch (err) {
    toast.error('Failed to update jackpot');
  }
};

export const deleteJackpot = async (id: number) => {
  try {
    const res = await api.delete(`/api/admin/jackpot/${id}`);
    toast.success(res.data.message);
    await fetchJackpots();
  } catch (err) {
    toast.error('Failed to delete jackpot');
  }
};
