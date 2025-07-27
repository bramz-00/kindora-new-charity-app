import { useState } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import { z } from "zod";

import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { CustomDialog } from "@/components/reuseable/CustomDialog";
import { userSchema } from "@/validations/user/user-validation";
import { useAuthStore } from "@/store/auth";
import { updateProfile } from "@/services/auth";

type FormData = z.infer<typeof userSchema>;

const EditProfile = () => {
    const [open, setOpen] = useState(false);
    const { user, fetchUser } = useAuthStore()


    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<FormData>({
        resolver: zodResolver(userSchema),
        defaultValues: {
            first_name: user?.first_name || "",
            email: user?.email || "",
            last_name: user?.last_name || "",
        },
    });

    const onSubmit = async (data: FormData) => {
        if (!user?.id) {
            alert("Utilisateur introuvable");
            return;
        }

        try {
            await updateProfile(data); // ← Suppose que ça throw en cas d’erreur
            await fetchUser();
            setOpen(false); // ✅ Tu fermes ici SEULEMENT si tout passe
        } catch (error) {
            console.error("Erreur de soumission", error);
            // Optionnel : toast.error()
        }
    };


    return (
        <CustomDialog
            title="Edit my profile"
            description="Mettre à jour vos informations personnelles"
            onSubmit={handleSubmit(onSubmit)}
            triggerText="Modifier mon profil"
            open={open}
            setOpen={setOpen}
        >
            <div className="space-y-4">
                <div className="space-y-1">
                    <Label htmlFor="first_name">First Name</Label>
                    <Input id="first_name" {...register("first_name")} />
                    {errors.first_name && (
                        <p className="text-sm text-red-500">{errors.first_name.message}</p>
                    )}
                </div>
                     <div className="space-y-1">
                    <Label htmlFor="last_name">Last Name</Label>
                    <Input id="last_name" {...register("last_name")} />
                    {errors.last_name && (
                        <p className="text-sm text-red-500">{errors.last_name.message}</p>
                    )}
                </div>

                <div className="space-y-1">
                    <Label htmlFor="email">Email</Label>
                    <Input id="email" type="email" {...register("email")} />
                    {errors.email && (
                        <p className="text-sm text-red-500">{errors.email.message}</p>
                    )}
                </div>
            </div>
        </CustomDialog>
    );
};

export default EditProfile;
