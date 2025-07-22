import GuestLayout from "@/layouts/GuestLayout"
import logo from "../../../assets/images/logo/logo.png"
import Login from "./loginForm"
const LoginPage = () => {
  return (
    <GuestLayout>

      {/* <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-8 lg:px-8">
        <div className="sm:mx-auto sm:w-full sm:max-w-sm">
          <a href="#" className="flex items-center justify-center  ">
            <img
              alt=""
              src={logo}
              className="h-8 w-auto"
            />
            <span className="font-bold text-lg   text-blue-600  border-blue-600 rounded-r  -ml-1.5 mt-4 border px-1.5 h-8">indora</span>
          </a>
          <h2 className="mt-10 text-center text-2xl/3 font-bold tracking-tight text-gray-900">
            Sign in to your account
          </h2>
        </div>

        <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form action="#" method="POST" className="space-y-6">
            <div className="">
    
              <div className="">
                <input
                  id="email"
                  name="email"
                  type="email"
                  required
                  placeholder="Email"
                  autoComplete="email"
                  className="block w-full rounded-t-md border-b-0 border-x border-t  bg-white px-3 py-2 text-lg text-gray-900   -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-md/6"
                />
              </div>
              <div className="">
                <input
                  id="password"
                  name="password"
                  type="password"
                  required
                  placeholder="Password"
                  autoComplete="current-password"
                  className="block w-full rounded-b-md border bg-white px-3 py-2 text-lg text-gray-900   -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-md/6"
                />
              </div>
            </div>

             

                  <div className="text-sm">
                    <a href="#" className="font-semibold text-indigo-600 hover:text-indigo-500">
                      Forgot password?
                    </a>
                  </div>
            <div>
              <button
                type="submit"
                className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              >
                Sign in
              </button>
            </div>
          </form>

          <p className="mt-10 text-center text-sm/6 text-gray-500">
            Not a member?{' '}
            <a href="#" className="font-semibold text-indigo-600 hover:text-indigo-500">
              Start a 14 day free trial
            </a>
          </p>
        </div>
      </div> */}


<Login/>

    </GuestLayout>
  )
}

export default LoginPage