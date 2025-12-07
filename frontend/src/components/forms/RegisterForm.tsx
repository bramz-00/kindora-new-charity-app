import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import * as z from 'zod'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { useAuthStore } from '@/store/auth'
import { register } from '@/services/auth'
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from '../ui/form'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '../ui/card'
import { cn } from '@/lib/utils'
import { useState } from 'react'
import { LoaderIcon } from 'lucide-react'
import { Link, useNavigate } from 'react-router-dom'
import logo from "@/assets/images/logo/logo-light.svg"
import { toast } from 'sonner'

const schema = z.object({
    first_name: z.string().min(2, "First name must be at least 2 characters"),
    last_name: z.string().min(2, "Last name must be at least 2 characters"),
    email: z.string().email("Invalid email address"),
    password: z.string().min(8, "Password must be at least 8 characters"),
    password_confirmation: z.string().min(8, "Password confirmation must be at least 8 characters"),
}).refine((data) => data.password === data.password_confirmation, {
    message: "Passwords do not match",
    path: ["password_confirmation"],
})

export default function RegisterForm({
    className,
    ...props
}: React.ComponentProps<"div">) {
    const [loading, setLoading] = useState(false)
    const navigate = useNavigate()

    const form = useForm<z.infer<typeof schema>>({
        resolver: zodResolver(schema),
        defaultValues: {
            first_name: "",
            last_name: "",
            email: "",
            password: "",
            password_confirmation: "",
        },
    })

    const fetchUser = useAuthStore((state) => state.fetchUser)

    const onSubmit = async (values: z.infer<typeof schema>) => {
        try {
            setLoading(true)
            await register(values)
            await fetchUser()
            toast.success("Registration successful! Welcome aboard.")
            navigate('/') // Redirect to home or dashboard
        } catch (error: any) {
            console.error(error)
            if (error.response?.status === 422) {
                const errors = error.response.data.errors
                Object.keys(errors).forEach((key) => {
                    form.setError(key as any, {
                        type: "server",
                        message: errors[key][0],
                    })
                })
            } else {
                toast.error("Something went wrong. Please try again.")
            }
        } finally {
            setLoading(false)
        }
    }

    return (
        <div className={cn("flex flex-col gap-6", className)} {...props}>
            <Card className="overflow-hidden border-none shadow-none">
                <CardHeader className="space-y-1 text-center">
                    <div className="flex justify-center mb-4">
                        <Link to="/">
                            <img
                                alt="Logo"
                                src={logo}
                                className="h-12 w-auto"
                            />
                        </Link>
                    </div>
                    <CardTitle className="text-2xl font-bold tracking-tight">Create an account</CardTitle>
                    <CardDescription>
                        Enter your details below to create your account
                    </CardDescription>
                </CardHeader>
                <CardContent className="grid p-0">
                    <Form {...form}>
                        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-4 px-6 ">
                            <div className="grid grid-cols-2 gap-4">
                                <FormField
                                    control={form.control}
                                    name="first_name"
                                    render={({ field, fieldState }) => (
                                        <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                            <FormLabel>First Name</FormLabel>
                                            <FormControl>
                                                <Input placeholder="John" {...field} />
                                            </FormControl>
                                            <FormMessage className="absolute bottom-1 left-0" />
                                        </FormItem>
                                    )}
                                />
                                <FormField
                                    control={form.control}
                                    name="last_name"
                                    render={({ field, fieldState }) => (
                                        <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                            <FormLabel>Last Name</FormLabel>
                                            <FormControl>
                                                <Input placeholder="Doe" {...field} />
                                            </FormControl>
                                            <FormMessage className="absolute bottom-1 left-0" />
                                        </FormItem>
                                    )}
                                />
                            </div>
                            <FormField
                                control={form.control}
                                name="email"
                                render={({ field, fieldState }) => (
                                    <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                        <FormLabel>Email</FormLabel>
                                        <FormControl>
                                            <Input type="email" placeholder="m@example.com" {...field} />
                                        </FormControl>
                                        <FormMessage className="absolute bottom-1 left-0" />
                                    </FormItem>
                                )}
                            />
                            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <FormField
                                    control={form.control}
                                    name="password"
                                    render={({ field, fieldState }) => (
                                        <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                            <FormLabel>Password</FormLabel>
                                            <FormControl>
                                                <Input type="password" placeholder="********" {...field} />
                                            </FormControl>
                                            <FormMessage className="absolute bottom-1 left-0" />
                                        </FormItem>
                                    )}
                                />
                                <FormField
                                    control={form.control}
                                    name="password_confirmation"
                                    render={({ field, fieldState }) => (
                                        <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                            <FormLabel>Confirm Password</FormLabel>
                                            <FormControl>
                                                <Input type="password" placeholder="********" {...field} />
                                            </FormControl>
                                            <FormMessage className="absolute bottom-1 left-0" />
                                        </FormItem>
                                    )}
                                />
                            </div>

                            <Button disabled={loading} type="submit" className="w-full">
                                {loading ? <LoaderIcon className="mr-2 h-4 w-4 animate-spin" /> : 'Create Account'}
                            </Button>

                            <div className="relative">
                                <div className="absolute inset-0 flex items-center">
                                    <span className="w-full border-t" />
                                </div>
                                <div className="relative flex justify-center text-xs uppercase">
                                    <span className="bg-background px-2 text-muted-foreground">
                                        Or continue with
                                    </span>
                                </div>
                            </div>


                            <div className="text-center text-sm">
                                Already have an account?{" "}
                                <Link to="/login" className="underline underline-offset-4 hover:text-primary">
                                    Sign in
                                </Link>
                            </div>
                        </form>
                    </Form>
                </CardContent>
            </Card>

        </div>
    )
}
