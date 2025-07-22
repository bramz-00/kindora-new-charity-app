import axios from 'axios';
const baseURL = import.meta.env.VITE_API_BASE_URL_TEST||"http://localhost:8000" ;


const api = axios.create({
  baseURL: baseURL,
  withCredentials: true,            // pour les cookies
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
    xsrfCookieName: 'laravel_session', // le nom du cookie généré par Laravel Sanctum
  xsrfHeaderName: 'X-XSRF-TOKEN', // le nom de l'en-tête envoyé à Laravel

});

export default api;
