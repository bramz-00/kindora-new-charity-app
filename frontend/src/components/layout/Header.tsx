
import { Link, useNavigate } from "react-router-dom"
import logo from "../../assets/images/logo/logo.png"
import { useEffect, useState } from "react";
import { useAuthStore } from "@/store/auth";
import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
} from "@/components/ui/dropdown-menu";
import { Avatar, AvatarFallback, AvatarImage } from "@radix-ui/react-avatar";
import { ConfirmDialog } from "../reuseable/ConfirmDialog";

export default function Header() {
  const { user } = useAuthStore();
  const logout = useAuthStore((state) => state.logout)
  const navigate = useNavigate()

  const handleLogout = async () => {
    await logout()
    navigate('/login')
  }

  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      const isScrolled = window.scrollY > 50;
      setScrolled(isScrolled);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);
  return (
    <header className={`sticky py-2 border-b items-center justify-between  bg-white backdrop-blur-2xl top-0 left-0 w-full z-50 transition-all duration-300 ${scrolled ? " border-gray-200" : "border-white"
      }`} >
      <nav aria-label="Top" className="mx-auto  px-4 sm:px-6 lg:px-12 ">
        <div className=" ">
          <div className="flex h-16 items-center">

            <div className="ml-4 flex lg:ml-0 lg:px-12">
              <Link to="/" className="flex items-center  ">
                <img
                  alt=""
                  src={logo}
                  className="h-8 w-auto"
                />
                <span className="font-bold text-lg lg:block hidden    text-blue-600  border-blue-600 rounded-r  -ml-1.5 mt-4 border px-1.5 h-8">indora</span>
              </Link>
            </div>

            {/* Flyout menus */}

            <div className="ml-auto flex items-center">
              <div className="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                               <span aria-hidden="true" className="h-6 w-px bg-gray-200" />

{user ?  <DropdownMenu>
                  <DropdownMenuTrigger className="flex items-center justify-between gap-4 space-x-4 ">
                    <span className="font-light text-primary capitalize g text-base cursor-pointer">
                      {user?.first_name}  {user?.last_name}
                    </span>
                    <Avatar className="h-12 w-12 ">
                      <AvatarImage src="https://github.com/shadcn.png" alt="@user" className="rounded-full " />
                      <AvatarFallback>JD</AvatarFallback>
                    </Avatar>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent align="end" className="mt-4 lg:w-48 w-40 p-3 space-y-1 ">
                    <DropdownMenuLabel>My Account</DropdownMenuLabel>
                    <DropdownMenuSeparator />
                    <DropdownMenuItem asChild className="px-3 w-full hover:bg-gray-100 ">
                      <ConfirmDialog
                        onConfirm={() => handleLogout()}
                        buttonConfirmText="Logout"
                        desc="want to logout"
                        trigger={
                          <button className="hover:bg-accent px-3 text-left rounded-sm py-1.5 text-sm w-full ">
                            Logout
                          </button>
                        }
                      />
                    </DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
               
               
               : <Link  to="/login" className="text-sm font-medium text-gray-700 hover:text-gray-800">
                  Sign in
                </Link>}
           
               
              </div>



              {/* Search */}
              <div className="flex lg:ml-6">
                <a href="#" className="p-2 text-gray-400 hover:text-gray-500">
                  <span className="sr-only">Search</span>
                </a>
              </div>

            </div>
          </div>
        </div>
      </nav>
    </header>

  )
}
