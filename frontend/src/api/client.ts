import axios from 'axios';
const baseURL = import.meta.env.VITE_API_BASE_URL_TEST || "http://localhost:8000";


const api = axios.create({
  baseURL: 'http://localhost:8000',
    withCredentials: true,
    withXSRFToken: true,

  headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      }
  // le nom de l'en-tête envoyé à Laravel

});

export default api;
