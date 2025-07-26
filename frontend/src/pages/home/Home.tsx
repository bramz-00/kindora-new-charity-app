import Header from "@/components/layout/Header"
import { CarouselCard } from "@/components/reuseable/Carousel"
import FeautureCard from "@/components/reuseable/FeautureCard"
import Jackpot from "@/components/reuseable/JackpotCard"
import JackpotList from "../features/jackpots/JackpotList"


const Home = () => {

  return (

    <div className="relative before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-1 before:transform before:-translate-x-1/2">
      <Header />


      <section className="w-full  px-4 sm:px-8 md:px-10 lg:0px-20  lg:h-screen">
        <div>
          <div className="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
            <div className="flex justify-center">
              <a className="inline-flex items-center gap-x-2 bg-white border border-gray-200 text-sm text-gray-800 p-1 ps-3 rounded-full transition hover:border-gray-300 focus:outline-hidden focus:border-gray-300 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:border-neutral-600 dark:focus:border-neutral-600" href="#">
                PRO release - Join to waitlist
                <span className="py-1.5 px-2.5 inline-flex justify-center items-center gap-x-2 rounded-full bg-gray-200 font-semibold text-sm text-gray-600 dark:bg-neutral-700 dark:text-neutral-400">
                  <svg className="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
                </span>
              </a>
            </div>

            <div className="mt-5 max-w-2xl text-center mx-auto">
              <h1 className="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200">
                Let's Build
                <span className="bg-clip-text bg-linear-to-tl from-blue-600 to-violet-600 text-transparent">Together</span>
              </h1>
            </div>


            <div className="mt-5 max-w-3xl text-center mx-auto">
              <p className="text-lg text-gray-600 dark:text-neutral-400">Preline UI is an open-source set of prebuilt UI components, ready-to-use examples and Figma design system based on the utility-first Tailwind CSS framework.</p>
            </div>

            <div className="mt-5 flex flex-col sm:flex-row justify-center items-center gap-1.5 sm:gap-3">
              <div className="flex flex-wrap gap-1 sm:gap-3">
                <span className="text-sm text-gray-600 dark:text-neutral-400">Package Manager:</span>
                <span className="text-sm font-bold text-gray-900 dark:text-white">npm</span>
              </div>
              <svg className="hidden sm:block size-5 text-gray-300 dark:text-neutral-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round" />
              </svg>
              <a className="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="../docs/index.html">
                Installation Guide
                <svg className="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section className="lg:p-8  w-full flex gap-2 lg:px-24 px-14   flex-col items-start justify-start">
        <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-blue-600 font-bold">Goods</h1>
        <div className="flex items-center justify-center w-full">
          <CarouselCard />
        </div>
      </section>

      <section className="lg:p-8  w-full flex gap-2 lg:px-24 px-14   flex-col items-start justify-start">
        <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-amber-400 font-bold">Events</h1>
        <div className="flex items-center justify-center w-full">
          <CarouselCard />
        </div>
      </section>
      <section className="lg:p-8  w-full flex gap-2 lg:px-24 px-14   flex-col items-start justify-start">
        <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-purple-400 font-bold">Jackpots</h1>
        <div className="flex items-center justify-center w-full">
          <CarouselCard />
        </div>
      </section>
      <section className="lg:p-8  w-full flex gap-2 lg:px-24 px-14   flex-col items-start justify-start">
        <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-purple-400 font-bold">Jackpots</h1>
        <div className="flex items-center justify-center w-full">
          <CarouselCard />


        </div>
        <div className="">

          <FeautureCard />
          <JackpotList/>
        </div>
      </section>
    </div>
  )
}

export default Home