import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import * as z from 'zod'

import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { useNavigate } from 'react-router-dom'
import { useAuthStore } from '@/store/auth'
import { login } from '@/services/auth'

const schema = z.object({
  email: z.string().email(),
  password: z.string().min(6),
})

type FormValues = z.infer<typeof schema>

export default function LoginForm() {
  const { register, handleSubmit, formState: { errors } } = useForm<FormValues>({
    resolver: zodResolver(schema),
  })

  const fetchUser = useAuthStore((state) => state.fetchUser)
  const navigate = useNavigate()

  const onSubmit = async (values: FormValues) => {
    try {
      await login(values)
      await fetchUser()
      navigate('/dashboard')
    } catch (error) {
      console.error(error)
    }
  }

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
      <Input placeholder="Email" {...register('email')} />
      {errors.email && <p>{errors.email.message}</p>}
      <Input type="password" placeholder="Password" {...register('password')} />
      {errors.password && <p>{errors.password.message}</p>}
      <Button type="submit">Login</Button>
    </form>
  )
}
