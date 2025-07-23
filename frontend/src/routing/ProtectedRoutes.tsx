import { useAuthStore } from '@/store/auth'
import { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'

export default function ProtectedRoute({ children }: { children: React.ReactNode }) {
  const user = useAuthStore((state) => state.user)
  const fetchUser = useAuthStore((state) => state.fetchUser)
  const [loading, setLoading] = useState(true)
  const navigate = useNavigate()

  useEffect(() => {
    const checkAuth = async () => {
      await fetchUser()
      setLoading(false)
    }
    checkAuth()
  }, [])

  useEffect(() => {
    if (!loading && !user) {
      navigate('/login')
    }
  }, [loading, user])

  if (loading) return <p>Chargement...</p>

  return <>{children}</>
}



