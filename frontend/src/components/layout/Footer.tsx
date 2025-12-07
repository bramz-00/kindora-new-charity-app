import { Link } from "react-router-dom"
import logo from "@/assets/images/logo/logo-light.svg"

const Footer = () => {
    return (
        <div>

            <footer className="bg-white border border-x mx-5 rounded-4xl ">
                <div className="mx-auto max-w-screen-4xl ml-4 px-4 pt-16 pb-8 sm:px-6 lg:px-16">
                    <Link to="/" className="flex items-center  ">
                        <img
                            alt=""
                            src={logo}
                            className="h-12 w-auto"
                        />
                    </Link>

                    <div className="mt-16 border-t border-gray-100 pt-8">
                        <p className="text-center text-xs/relaxed text-gray-500">
                            © Kindora 2025. All rights reserved.

                            <br />

                            Created by
                            <a href="#" className="ml-1 text-gray-700 underline transition hover:text-gray-700/75">Zakaria Braham</a>

                        </p>
                    </div>
                </div>
            </footer>
        </div>
    )
}

export default Footer