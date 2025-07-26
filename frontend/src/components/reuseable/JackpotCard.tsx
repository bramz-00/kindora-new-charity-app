import { cn } from "@/lib/utils"
import type { Jackpot } from '@/types/admin'



export default function JackpotCard({jackpot}:{jackpot:Jackpot}) {
  return (

          <div
            key={jackpot.id}
            className={cn(
              !jackpot.title ? 'relative bg-gray-900 shadow-2xl' : 'bg-white/60 sm:mx-2 lg:mx-0',
             
              'rounded-3xl p-8 ring-1 ring-gray-900/10 sm:p-10',
            )}
          >
            <h3
              className={cn(!jackpot.title ? 'text-indigo-400' : 'text-indigo-600', 'text-base/7 font-semibold')}
            >
              {jackpot.title}
            </h3>
            <p className="mt-4 flex items-baseline gap-x-2">
              <span
                className={cn(
                  !jackpot.title ? 'text-white' : 'text-gray-900',
                  'text-5xl font-semibold tracking-tight',
                )}
              >
                {jackpot.title}
              </span>
              <span className={cn(jackpot.title ? 'text-gray-400' : 'text-gray-500', 'text-base')}>/month</span>
            </p>
            <p className={cn(!jackpot.title ? 'text-gray-300' : 'text-gray-600', 'mt-6 text-base/7')}>
              {jackpot.description}
            </p>
        
            <a
              href={jackpot.title}
              aria-describedby={jackpot.id}
              className={cn(
                !jackpot.title
                  ? 'bg-indigo-500 text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-indigo-500'
                  : 'text-indigo-600 ring-1 ring-indigo-200 ring-inset hover:ring-indigo-300 focus-visible:outline-indigo-600',
                'mt-8 block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold focus-visible:outline-2 focus-visible:outline-offset-2 sm:mt-10',
              )}
            >
              Get started today
            </a>
          </div>
      
    
  )
}
