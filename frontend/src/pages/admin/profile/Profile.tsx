import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import EditProfile from './EditProfile'
import { useAuthStore } from '@/store/auth'
import UserLayout from '@/layouts/UserLayout'

const Profile = () => {
        const { user } = useAuthStore()
    
  return (
    <UserLayout>
        

      <div className="max-w-6xl mx-auto px-4 py-10 space-y-8">
        {/* Profile Header */}
        <Card className="rounded-2xl shadow-sm border border-muted">
          <CardHeader className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div className="flex items-center gap-4">
              <Avatar  className="h-16 w-16">
                <AvatarImage  alt="@user" />
                <AvatarFallback>JD</AvatarFallback>
              </Avatar>
              <div>
                <h2 className="text-xl text-primary font-semibold">{user?.full_name}</h2>
                <p className="text-muted-foreground text-sm">{user?.email}</p>
                <p className="text-muted-foreground text-sm">{user?.phone}</p>
              </div>
            </div>
            <EditProfile/>
          </CardHeader>
        </Card>

        {/* Tabs Section */}
        <Tabs defaultValue="documents" className="space-y-4">
          <TabsList className="bg-muted p-1 rounded-xl w-full sm:w-auto">
            <TabsTrigger value="documents">📄 Documents</TabsTrigger>
            <TabsTrigger value="activity">📊 Activités</TabsTrigger>
            <TabsTrigger value="tasks">✅ Tâches</TabsTrigger>
          </TabsList>

          <TabsContent value="documents">
            <Card className="rounded-2xl border shadow-sm">
              <CardHeader>
                <CardTitle className="text-base text-muted-foreground">Mes documents</CardTitle>
              </CardHeader>
              <CardContent className="space-y-2 text-sm text-muted-foreground">
                <p>• Contrat_emploi.pdf</p>
                <p>• Carte_nationale.png</p>
                <p>• Justificatif_domicile.pdf</p>
              </CardContent>
            </Card>
          </TabsContent>

          <TabsContent value="activity">
            <Card className="rounded-2xl border shadow-sm">
              <CardHeader>
                <CardTitle className="text-base text-muted-foreground">Historique des activités</CardTitle>
              </CardHeader>
              <CardContent className="space-y-2 text-sm text-muted-foreground">
                <p>🕒 Connexion depuis Alger, 10:23</p>
                <p>📁 Document téléchargé - CV.pdf</p>
                <p>🔒 Changement de mot de passe</p>
              </CardContent>
            </Card>
          </TabsContent>

          <TabsContent value="tasks">
            <Card className="rounded-2xl border shadow-sm">
              <CardHeader>
                <CardTitle className="text-base text-muted-foreground">Tâches personnelles</CardTitle>
              </CardHeader>
              <CardContent className="space-y-2 text-sm text-muted-foreground">
                <p>✅ Compléter le formulaire RH</p>
                <p>🕐 Soumettre le rapport mensuel</p>
                <p>🟡 Relancer le support technique</p>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </div>

    </UserLayout>
  )
}

export default Profile