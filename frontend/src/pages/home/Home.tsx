import Header from "@/components/layout/Header"
import { useAuthStore } from "@/store/useAuthStore";

const Home = () => {
    const {user} = useAuthStore();
  
  return (

    <div>
      <Header />
      {user && (
        <div className="text-center mt-4">
          <h2 className="text-2xl font-bold">Welcome, {user.first_name || user.email}!</h2>
          <p className="text-gray-600">You are logged in.</p>     
        </div>
      )}

      <section className="w-full  px-4 sm:px-8 md:px-10 lg:0px-20  lg:h-screen">
        <div
          className="w-full rounded-[20px] sm:rounded-[30px] md:rounded-[30px] lg:rounded-[30px] bg-primary   flex flex-col   items-center  py-8 sm:py-8 md:py-9 lg:py-62  px-4  sm:px-4 md:px-8 xl:px-16" >
          <div className="text-center  text-white">
            <h1
              className="text-3xl leading-[48px] md:text-5xl text-white md:leading-[58px] lg:text-[50px] lg:leading-[70px] font-bold mb-6 md:mb-12">
              Elevate Your Style with Modern Design.
            </h1>
            <span className="text-xl leading-[34px] underline font-semibold sm:text-[24px] mb-3 mt-5">
              Discover Unique Creations!

            </span>
            <br />
            <p className="text-xl leading-[27px]  font-normal sm:text-[24px] mb-8 md:mb-12">
              Explore innovative designs crafted with precision and elegance to enhance your lifestyle.

            </p>
            <div className="flex items-center justify-center sm:justify-center">
              <button className="w-full flex items-center  justify-center text-xl lg:text-2xl outline-gray-600   font-bold hover:bg-[#3b3b3b] cursor-pointer rounded-[38px] bg-[#262626] text-white py-3 px-6 sm:px-9"><span>
                Get Started
              </span>
              </button>

            </div>
          </div>
        </div>
      </section>

    </div>
  )
}

export default Home