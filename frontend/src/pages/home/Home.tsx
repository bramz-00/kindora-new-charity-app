import Header from "@/components/layout/Header"
import { CarouselCard } from "@/components/reuseable/Carousel"
import FeautureCard from "@/components/reuseable/FeautureCard"
import Jackpot from "@/components/reuseable/JackpotCard"
import JackpotList from "../features/jackpots/JackpotList"
import Footer from "@/components/layout/Footer"
import { useState, useEffect } from "react"

const Home = () => {
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    setIsVisible(true);
  }, []);

  const stats = [
    { number: "10K+", label: "Lives Changed" },
    { number: "500+", label: "Volunteers" },
    { number: "50+", label: "Communities" },
    { number: "98%", label: "Impact Rate" }
  ];

  return (
    <div className="relative">
      {/* Animated Background Elements */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        <div className="absolute -top-40 -right-40 w-96 h-96 bg-[#9542be]/10 rounded-full blur-3xl animate-pulse"></div>
        <div className="absolute top-1/4 -left-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div className="absolute bottom-1/4 right-1/3 w-64 h-64 bg-purple-400/10 rounded-full blur-3xl animate-pulse delay-2000"></div>
      </div>

      {/* Floating geometric shapes */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        <div className="absolute top-1/4 left-1/4 w-4 h-4 bg-[#9542be]/20 rotate-45 animate-bounce delay-300"></div>
        <div className="absolute top-1/3 right-1/4 w-6 h-6 bg-blue-500/20 rounded-full animate-bounce delay-700"></div>
        <div className="absolute bottom-1/3 left-1/3 w-3 h-3 bg-purple-400/30 animate-bounce delay-1000"></div>
      </div>

      <Header />

      {/* Hero Section */}
      <section className="relative  flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div className="max-w-7xl mx-auto w-full">
          <div className="text-center space-y-8">
            
            {/* Badge */}
            <div className={`inline-flex items-center gap-x-2 bg-white/80 backdrop-blur-sm border border-[#9542be]/20 text-sm text-gray-800 px-4 py-2 rounded-full transition-all duration-1000 transform hover:scale-105 hover:bg-[#9542be]/10 ${isVisible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'}`}>
              <span className="w-2 h-2 bg-[#9542be] rounded-full animate-pulse"></span>
              <span className="font-medium">Making Impact Together</span>
              <svg className="w-4 h-4 text-[#9542be]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>

            {/* Main Headline */}
            <div className={`space-y-6 transition-all duration-1000 delay-300 transform ${isVisible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'}`}>
              <h1 className="text-xl flex gap-2 justify-center sm:text-3xl lg:text-5xl font-bold text-gray-900 leading-tight">
                Empowering
                <span className="block bg-gradient-to-r from-[#9542be] via-purple-600 to-blue-600 bg-clip-text text-transparent animate-gradient">
                  Communities
                </span>
                <span className="block">Together</span>
              </h1>
              
              <p className="max-w-2xl mx-auto text-xl sm:text-2xl text-gray-600 leading-relaxed">
                Join our mission to create lasting change through innovation, compassion, and collective action. Every contribution makes a difference.
              </p>
            </div>

            {/* CTA Buttons */}
            <div className={`flex flex-col sm:flex-row gap-4 justify-center items-center transition-all duration-1000 delay-500 transform ${isVisible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'}`}>
              <button className="group relative px-8 py-4 bg-[#9542be] text-white font-semibold rounded-full hover:bg-[#9542be]/90 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-[#9542be]/25 overflow-hidden">
                <span className="relative z-10 flex items-center gap-2">
                  Start Making Impact
                  <svg className="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                  </svg>
                </span>
                <div className="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </button>
              
              <button className="group px-8 py-4 border-2 border-[#9542be] text-[#9542be] font-semibold rounded-full hover:bg-[#9542be] hover:text-white transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Learn Our Story

              </button>
            </div>

            {/* Stats Section */}
            <div className={`grid grid-cols-2 lg:grid-cols-4 gap-8 pt-16 transition-all duration-1000 delay-700 transform ${isVisible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'}`}>
              {stats.map((stat, index) => (
                <div key={index} className="group">
                  <div className="bg-white/50 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:bg-white/70 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div className="text-3xl lg:text-4xl font-bold text-[#9542be] mb-2 group-hover:scale-110 transition-transform duration-300">
                      {stat.number}
                    </div>
                    <div className="text-gray-600 font-medium">
                      {stat.label}
                    </div>
                  </div>
                </div>
              ))}
            </div>

            {/* Scroll Indicator */}
            <div className={`absolute bottom-8 left-1/2 transform -translate-x-1/2 transition-all duration-1000 delay-1000 ${isVisible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'}`}>
              <div className="flex flex-col items-center gap-2 text-gray-400 hover:text-[#9542be] transition-colors">
                <span className="text-sm font-medium">Explore More</span>
                <div className="w-6 h-10 border-2 border-current rounded-full flex justify-center">
                  <div className="w-1 h-3 bg-current rounded-full animate-bounce mt-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Existing Sections */}
      <div className="space-y-10">
        <section className="lg:p-8 w-full flex gap-2 lg:px-24 px-14 flex-col items-start justify-start">
          <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-primary font-bold">Goods</h1>
          <div className="flex items-center justify-center w-full">
            <CarouselCard />
          </div>
        </section>

        <section className="lg:p-8 w-full flex gap-2 lg:px-24 px-14 flex-col items-start justify-start">
          <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-amber-400 font-bold">Events</h1>
          <div className="flex items-center justify-center w-full">
            <CarouselCard />
          </div>
        </section>

        <section className="lg:p-8 w-full flex gap-2 lg:px-24 px-14 flex-col items-start justify-start">
          <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-purple-500 font-bold">Volunteer Opportunity</h1>
          <div className="flex items-center justify-center w-full">
            <CarouselCard />
          </div>
        </section>

        <section className="lg:p-8 w-full flex gap-2 lg:px-24 px-14 flex-col items-start justify-start">
          <h1 className="text-4xl text-left border-b pb-2 w-full mb-16 text-teal-700 font-bold">Jackpots</h1>
          <div className="flex items-center justify-center w-full">
            <CarouselCard />
          </div>
        </section>
      </div>

      <div className="px-8">
        <FeautureCard />
        <JackpotList />
      </div>
      
      <Footer />

      <style >{`
        @keyframes gradient {
          0%, 100% {
            background-position: 0% 50%;
          }
          50% {
            background-position: 100% 50%;
          }
        }
        .animate-gradient {
          background-size: 200% 200%;
          animation: gradient 3s ease infinite;
        }
      `}</style>
    </div>
  )
}

export default Home