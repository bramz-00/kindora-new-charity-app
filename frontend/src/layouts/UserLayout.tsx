
// src/routing/UserLayout.tsx
import Footer from "@/components/layout/Footer"
import Header from "@/components/layout/Header"

const UserLayout = ({ children }: { children: React.ReactNode }) => {
    return (
        <div>
            <Header />
            <main className="p-6">
                {children}
            </main>
            <Footer/>
        </div>
    )
}

export default UserLayout