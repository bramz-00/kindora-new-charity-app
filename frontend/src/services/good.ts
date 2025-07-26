// services/good/good.service.ts
import { toast } from 'sonner';
import api from '@/api/client';
import type { Good } from '@/types/admin';
import { useGoodStore } from '@/store/good';

export const fetchGoods = async () => {
  const { setLoading, setGoods } = useGoodStore.getState();
  setLoading(true);
  try {
    const res = await api.get('/api/admin/good');
    setGoods(res.data.data);
  } catch (err) {
    toast.error('Failed to fetch goods');
  } finally {
    setLoading(false);
  }
};

export const createGood = async (data: Partial<Good>) => {
  try {
    const res = await api.post('/api/admin/good', data);
    toast.success(res.data.message);
    await fetchGoods();
  } catch (err) {
    toast.error('Failed to create good');
  }
};

export const updateGood = async (data: Partial<Good>) => {
  try {
    await api.put(`/api/admin/good`, data);
    toast.success('Good updated');
    await fetchGoods();
  } catch (err) {
    toast.error('Failed to update good');
  }
};

export const deleteGood = async (id: number) => {
  try {
    const res = await api.delete(`/api/admin/good/${id}`);
    toast.success(res.data.message);
    await fetchGoods();
  } catch (err) {
    toast.error('Failed to delete good');
  }
};
