import { useAuthStore } from '@/store/auth';
import { Navigate, Outlet, useLocation } from 'react-router-dom';

export function ProtectedRoute() {
const { user, loading } = useAuthStore();
  const location = useLocation();

if (loading) {
  return <div>Loading...</div>; // or your spinner component
}

if (!user) {
  return <Navigate to="/login" state={{ from: location }} replace />;
}

return <Outlet />;
}


