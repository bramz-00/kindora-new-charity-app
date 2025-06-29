import axios from 'axios';
const baseURL = import.meta.env.VITE_API_BASE_URL_TEST||"http://localhost:8000/api" ;


const api = axios.create({
  baseURL: baseURL,
  withCredentials: true,
});

export default api;
