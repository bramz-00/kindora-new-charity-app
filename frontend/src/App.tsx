import { useEffect } from 'react'
import { useAuthStore } from './store/auth'
import LoginPage from './pages/auth/login/Login'
import ProtectedRoute from './routing/ProtectedRoutes'
import DashboardPage from './pages/dashboard/Dashboard'
import { Route, Routes } from 'react-router-dom'
import Home from './pages/home/Home'

export default function App() {
  const { user, fetchUser } = useAuthStore()

  useEffect(() => {
    if (user ) {
      fetchUser()
    }
  },[])

  return (
    <Routes>
      <Route path="/login" element={<LoginPage />} />
      <Route path="/" element={<Home />} />

      <Route
        path="/dashboard"
        element={
          <ProtectedRoute>
            <DashboardPage />
          </ProtectedRoute>
        }
      />
    </Routes>
  )
}
