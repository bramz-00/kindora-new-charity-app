import type { Good } from '@/types/admin'

const GoodCard = ({ good }: { good: Good }) => {
    return (
        <div>
            <div className="max-w-sm w-full bg-white rounded-2xl border overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img className="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1753453068231-8f25e051b0c3?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image de l'objet" />
                <div className="p-4 space-y-2">
                    <h2 className="text-lg font-semibold text-gray-800 uppercase truncate">{good.title}</h2>
                    <p className="text-sm text-gray-500 line-clamp-2">{good.description}</p>

                    <div className="flex items-center justify-between text-sm text-gray-600">
                        <span className="bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full text-xs font-medium">Catégorie</span>
                        <span className="text-xs italic">État: <span className="font-semibold text-gray-700">usagé</span></span>
                    </div>

                    <div className="flex items-center justify-between mt-3">
                        <span className="text-xs text-green-600 font-medium bg-green-100 px-2 py-1 rounded-md">Disponible</span>
                        <a href="#" className="text-sm text-indigo-600 hover:underline font-medium">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default GoodCard