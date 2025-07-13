// src/components/LoginForm.tsx
import { login } from "@/services/authService";
import { useAuthStore } from "@/store/useAuthStore";
import { useState } from "react";


export default function LoginForm() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const setUser = useAuthStore((s) => s.setUser);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            await login(email, password);
            // fetch user again after login
            const res = await fetch("http://localhost:8000/api/user", {
                credentials: "include",
            });
            const user = await res.json();
            setUser(user);
        } catch (err) {
            alert("Login failed");
        }
    };

    return (
        <form onSubmit={handleSubmit} className="mt-10 sm:mx-auto sm:w-full sm:max-w-sm space-y-6">
            <input
                className="block w-full rounded-t-md border-b-0 border-x border-t  bg-white px-3 py-2 text-lg text-gray-900   -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-md/6"

                value={email} onChange={(e) => setEmail(e.target.value)} placeholder="Email" />
            <input
                className="block w-full rounded-b-md border bg-white px-3 py-2 text-lg text-gray-900   -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-md/6"
                type="password" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="Password" />
            <button className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                type="submit">Login</button>
        </form>
    );
}
