import Header from "@/components/layout/Header"

const Home = () => {
  return (

    <div>
      <Header/>

      <section className="mx-auto  max-w-[1440px] min-w-[280px] py-2 px-4 sm:px-8 md:px-10 lg:0px-20 ">
        <div
          className="w-full rounded-[50px] sm:rounded-[60px] md:rounded-[70px] lg:rounded-[80px] bg-primary   flex flex-col lg:flex-row  items-center  py-6 sm:py-8 md:py-9 lg:py-6  px-2  sm:px-4 md:px-8 xl:px-16" >
        <img className="w-full lg:w-1/2 xl:w-full max-w-[550px] lg:order-2" src="https://iili.io/2ysFUen.png" alt=""/>
          <div className="text-center md:text-left">
            <h1
              className="text-4xl leading-[48px] md:text-5xl md:leading-[58px] lg:text-[50px] lg:leading-[70px] font-bold mb-6 md:mb-12">
              Elevate Your Style with Modern Design.
            </h1>
            <span className="text-xl leading-[34px] underline font-semibold sm:text-[24px] mb-3 mt-5">
              Discover Unique Creations!

            </span>
            <br />
            <p className="text-xl leading-[27px]  font-normal sm:text-[24px] mb-8 md:mb-12">
              Explore innovative designs crafted with precision and elegance to enhance your lifestyle.

            </p>
            <button className="w-full flex items-center  justify-between outline-gray-600 max-w-[350px] text-xl  font-bold sm:text-lg  rounded-[38px] bg-[#262626] text-white py-4 px-6 sm:px-9"><span>
              Get Started
            </span>
              </button>
          </div>
        </div>
      </section>
    </div>
  )
}

export default Home