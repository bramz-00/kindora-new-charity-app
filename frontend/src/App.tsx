import './App.css'
import { Routes, Route, Link } from 'react-router-dom';
import Login from './pages/auth/login/Login';
import Home from './pages/home/Home';
import Register from './pages/auth/register/Register';


function App() {


  return (
    <>
     
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes>

    </>
  )
}

export default App



