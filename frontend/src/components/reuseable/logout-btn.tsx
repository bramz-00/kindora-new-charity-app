import { useNavigate } from 'react-router-dom'
import { Button } from '@/components/ui/button'
import { useAuthStore } from '@/store/auth'

export default function LogoutButton() {
  const logout = useAuthStore((state) => state.logout)
  const navigate = useNavigate()

  const handleLogout = async () => {
    await logout()
    navigate('/login')
  }

  return <Button onClick={handleLogout}>Logout</Button>
}