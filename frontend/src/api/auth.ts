import { useAuthStore } from "@/store/useAuthStore";
import api from "./client";

export const login = async (email: string, password: string) => {
  try {
    const response = await api.post('/login', { email, password });
    return response.data;
  } catch (error) {
    console.error(error);
  }
};

export const logout = async () => {
  try {
    const response = await api.post('/logout');
    return response.data;
  } catch (error) {
    console.error(error);
  }
};


export const loadUserFromSession = async () => {
  try {
    const res = await api.get('/api/user-load'); // Already includes cookies
    useAuthStore.getState().setUser(res.data.data);
  } catch (error) {
    console.error('User not logged in:', error);
    useAuthStore.getState().setUser(null);
  }
};