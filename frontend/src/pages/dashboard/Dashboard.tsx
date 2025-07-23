import LogoutButton from "@/components/reuseable/logout-btn"
import { useAuthStore } from "@/store/auth"

export default function DashboardPage() {
  const user = useAuthStore((state) => state.user)
  return <div className="p-4">Welcome, {user?.email}
  
  <LogoutButton/>
  </div>
}