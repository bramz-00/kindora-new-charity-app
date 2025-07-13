import './App.css'
import { Routes, Route, Link } from 'react-router-dom';
import Login from './pages/auth/login/Login';
import Home from './pages/home/Home';
import Register from './pages/auth/register/Register';
import { useAuthStore } from './store/useAuthStore';
import { useEffect } from 'react';
import LoginForm from './pages/auth/login/loginForm';

function App() {
    const { user, loading, fetchUser } = useAuthStore();

  useEffect(() => {
    fetchUser();
  }, []);

  return (
    <>
     
      {/* <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes> */}
        {user ? (
        <h1>Welcome, {user.name}</h1>
      ) : (
        <>
          <h1>Please login</h1>
          <LoginForm />
        </>
      )}
    </>
  )
}

export default App



