import GuestLayout from "@/layouts/GuestLayout"
import RegisterForm from "@/components/forms/RegisterForm"

const Register = () => {
  return (
    <GuestLayout>
        <div className="flex  flex-col items-center justify-center p-6 md:p-10">
      <div className="w-full max-w-sm md:max-w-3xl">
        <RegisterForm />
      </div>
    </div>
    </GuestLayout>
  )
}

export default Register