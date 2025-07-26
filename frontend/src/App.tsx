import { useEffect } from 'react'
import { useAuthStore } from './store/auth'
import LoginPage from './pages/auth/login/Login'
import DashboardPage from './pages/dashboard/Dashboard'
import { Route, Routes } from 'react-router-dom'
import Home from './pages/home/Home'
import { GuestRoute } from './routing/GuestRoute'
import { ProtectedRoute } from './routing/ProtectedRoutes'

export default function App() {
  const { user, fetchUser } = useAuthStore()

  useEffect(() => {
      fetchUser()
    
  }, [])

  return (
    <Routes>
      <Route element={<GuestRoute />}>
        <Route path="/login" element={<LoginPage />} />
      </Route>
        <Route path="/" element={<Home />} />
      <Route element={<ProtectedRoute />}>
        <Route path="/dashboard" element={<DashboardPage />} />
      </Route>
    </Routes>
  )
}
