import { SectionCards } from '@/components/ui/section-cards'
import AdminLayout from '@/layouts/AdminLayout'


const Dashboard = () => {
    return (
        <AdminLayout>
        <div className="flex flex-1 flex-col gap-4 p-1">

            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">

                <SectionCards />
            </div>

            {Array.from({ length: 24 }).map((_, index) => (
                <div
                    key={index}
                    className="bg-muted/50 aspect-video h-12 w-full rounded-lg"
                />
            ))}
            </div>

        </AdminLayout>
    )
}

export default Dashboard