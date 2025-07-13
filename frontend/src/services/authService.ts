// src/services/authService.ts

import api from "@/api/client";

export const getUser = async () => {
  const res = await api.get("/user");
  return res.data;
};

export const login = async (email: string, password: string) => {
  await api.get("/sanctum/csrf-cookie"); // Get CSRF cookie
  await api.post("/login", { email, password });
};

export const logout = async () => {
  await api.post("/logout");
};
