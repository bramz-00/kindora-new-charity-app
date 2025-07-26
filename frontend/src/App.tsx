import { useEffect } from 'react'
import { useAuthStore } from './store/auth'
import LoginPage from './pages/auth/login/Login'
import { Route, Routes } from 'react-router-dom'
import Home from './pages/home/Home'
import { GuestRoute } from './routing/GuestRoute'
import { ProtectedRoute } from './routing/ProtectedRoutes'
import Dashboard from './pages/admin/dashboard/index'

export default function App() {
  const { fetchUser } = useAuthStore()

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
        <Route path="/admin" >
          <Route path="dashboard" element={<Dashboard />} />
        </Route>
      </Route>
    </Routes>
  )
}
