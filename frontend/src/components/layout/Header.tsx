
import { Link } from "react-router-dom"
import logo from "../../assets/images/logo/logo.png"
import { useEffect, useState } from "react";
export default function Header() {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      // Changer à 50 selon tes besoins
      const isScrolled = window.scrollY > 50;
      setScrolled(isScrolled);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);
  return (
   <header  className={`sticky py-2 border-b items-center justify-between  bg-white backdrop-blur-2xl top-0 left-0 w-full z-50 transition-all duration-300 ${
    scrolled ? " border-gray-200" : "border-white"
  }`} >
        <nav aria-label="Top" className="mx-auto  px-4 sm:px-6 lg:px-12 ">
          <div className=" ">
            <div className="flex h-16 items-center">

              <div className="ml-4 flex lg:ml-0 lg:px-12">
                <a href="#" className="flex items-center  ">
                  <img
                    alt=""
                    src={logo}
                    className="h-8 w-auto"
                  />
                  <span className="font-bold text-lg lg:block hidden    text-blue-600  border-blue-600 rounded-r  -ml-1.5 mt-4 border px-1.5 h-8">indora</span>
                </a>
              </div>

              {/* Flyout menus */}
          
              <div className="ml-auto flex items-center">
                <div className="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                  <Link to="/login" className="text-sm font-medium text-gray-700 hover:text-gray-800">
                    Sign in
                  </Link>
                  <span aria-hidden="true" className="h-6 w-px bg-gray-200" />
                  <Link to="/register" className="text-sm font-medium text-gray-700 hover:text-gray-800">
                    Create account
                  </Link>
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
