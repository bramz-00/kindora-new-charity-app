import { z } from 'zod';




export const userSchema = z.object({
    last_name: z.string().min(2),
    first_name: z.string().min(2),
    email: z.string().email(),
});
