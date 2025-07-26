import JackpotCard from '@/components/reuseable/JackpotCard'
import { useJackpotStore } from '@/store/jackpot'
import React, { useEffect } from 'react'

const JackpotList = () => {
    const { jackpots, fetchJackpots, } = useJackpotStore()

    useEffect(() => {
        fetchJackpots()
    }, [])
    return (
        <div>
            <div className="relative isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
                <div aria-hidden="true" className="absolute inset-x-0 -top-3 -z-10 transform-gpu overflow-hidden px-36 blur-3xl">
                    <div
                        style={{
                            clipPath:
                                'polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)',
                        }}
                        className="mx-auto aspect-1155/678 w-288.75 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30"
                    />
                </div>
                <div className="mx-auto max-w-4xl text-center">
                    <h2 className="text-base/7 font-semibold text-indigo-600">Pricing</h2>
                    <p className="mt-2 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-6xl">
                        Choose the right plan for you
                    </p>
                </div>
                <p className="mx-auto mt-6 max-w-2xl text-center text-lg font-medium text-pretty text-gray-600 sm:text-xl/8">
                    Choose an affordable plan that’s packed with the best features for engaging your audience, creating customer
                    loyalty, and driving sales.
                </p>
                <div className="mx-auto mt-16 grid  gap-4 grid-cols-1 items-center gap-y-6 sm:mt-20 sm:gap-y-4  lg:grid-cols-2">
                    {jackpots.map((jackpot) => (
                        <div key={jackpot.id} className="flex items-center justify-center w-full">
                                <JackpotCard jackpot={jackpot} />
                            
                        </div>
                    ))}

                </div>
            </div>

        </div>
    )
}

export default JackpotList