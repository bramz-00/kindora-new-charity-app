export interface User {
    id: number
    first_name: string
    last_name: string
    full_name: string
    phone: string
    birth_date: string | null
    is_active: boolean
    email_verified: boolean | number
    email: string
    email_verified_at: string | null
    created_at: string
    joined_date: string
    token: string
}
export interface Good {
    id: number
    title: string
    description: string
    slug: string
    good_uuid: string
    state: string | null
    is_active: boolean
    status: boolean | number
    exchange_condition: string
    type: string
    created_at: string
    joined_date: string
    owner_id: User,
    category_id: number
}




export interface Jackpot {
    id: number
    organisation_id: number
    created_by_id: number
    title: string
    description: string
    target_amount: number
    collected_amount: number
    start_date: string // ou Date selon ton usage
    ends_at: string // ou Date
    status: 'pending' | 'active' | 'completed' | 'cancelled'
    is_active: boolean
}
