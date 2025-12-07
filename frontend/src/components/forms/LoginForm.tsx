import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import * as z from 'zod'
import bg from '@/assets/images/login.webp'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { useAuthStore } from '@/store/auth'
import { login } from '@/services/auth'
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from '../ui/form'
import { Card, CardContent } from '../ui/card'
import { cn } from '@/lib/utils'
import { useState } from 'react'
import { LoaderIcon } from 'lucide-react'
import { Link } from 'react-router-dom'
import logo from "@/assets/images/logo/logo-light.svg"

const schema = z.object({
    email: z.string().email(),
    password: z.string().min(6),
})

export default function LoginForm({
    className,
    ...props
}: React.ComponentProps<"div">) {
    const [loading, setLoading] = useState(false)

    const form = useForm<z.infer<typeof schema>>({
        resolver: zodResolver(schema),
        defaultValues: {
            email: "",
            password: "",
        },
    })

    const fetchUser = useAuthStore((state) => state.fetchUser)

    const onSubmit = async (values: z.infer<typeof schema>) => {
        try {
            setLoading(true)

            // Simulate delay (e.g., 2 seconds)
            await new Promise(resolve => setTimeout(resolve, 500))

            await login(values)
            await fetchUser()
        } catch (error) {
            console.error(error)
        } finally {
            setLoading(false)
        }
    }

    return (
        <div className={cn("flex flex-col gap-6", className)} {...props}>
            <Card className="overflow-hidden p-0">
                <CardContent className="grid p-0 md:grid-cols-2">
                    <Form {...form}>

                        <form onSubmit={form.handleSubmit(onSubmit)} className="p-6 md:p-8">
                            <div className="flex flex-col gap-5">
                                <div className="flex flex-col items-center text-center">
                                    <Link to="/" className="flex items-center  ">
                                        <img
                                            alt=""
                                            src={logo}
                                            className="h-12 w-auto"
                                        />
                                    </Link>
                                    <h1 className="text-2xl font-bold">Welcome back</h1>
                                    <p className="text-muted-foreground text-balance">
                                        Login to your Acme Inc account
                                    </p>
                                </div>
                                <div className="grid gap-3">
                                    <FormField
                                        control={form.control}
                                        name="email"
                                        render={({ field, fieldState }) => (
                                            <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                                <FormLabel>Email</FormLabel>
                                                <FormControl>
                                                    <Input type='email' placeholder="Email" {...field} />
                                                </FormControl>
                                                <FormMessage className="absolute bottom-1 left-0" />
                                            </FormItem>
                                        )}
                                    />
                                </div>
                                <div className="grid gap-3">
                                    <FormField
                                        control={form.control}
                                        name="password"
                                        render={({ field, fieldState }) => (
                                            <FormItem className={cn("relative space-y-1", fieldState.error && "pb-6")}>
                                                <FormLabel>Password</FormLabel>
                                                <FormControl>
                                                    <Input type="password" placeholder="Password" {...field} />
                                                </FormControl>
                                                <FormMessage className="absolute bottom-1 left-0" />
                                            </FormItem>
                                        )} />
                                    <div className="flex items-center">
                                        <a
                                            href="#"
                                            className="ml-auto text-sm underline-offset-2 hover:underline"
                                        >
                                            Forgot your password?
                                        </a>
                                    </div>
                                </div>
                                <Button disabled={loading} type="submit">
                                    {loading ? <LoaderIcon className="animate-spin" /> : 'Login'}
                                </Button>


                                <div className="text-center text-sm">
                                    Don&apos;t have an account?{" "}
                                    <Link to="/register" className="underline underline-offset-4">
                                        Sign up
                                    </Link>
                                </div>
                            </div>
                        </form>
                    </Form>
                    <div className="bg-muted relative hidden md:block">
                        <img
                            src={bg}
                            alt="Image"
                            className="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
                        />
                    </div>
                </CardContent>
            </Card>

        </div>
    )
}
