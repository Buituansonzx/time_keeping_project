import './App.css';
import { Routes, Route, Navigate } from 'react-router-dom'
import Login from './pages/auth/Login';
import Home from './pages/Home';
import { useAuthContext } from './context/AuthContext';

function App() {
  const { user } = useAuthContext();

  return (
    <Routes>
      <Route path="/login" element={user ? <Navigate to="/" /> : <Login />} />

      {/* Route chính / */}
      <Route path="/" element={user ? <Home /> : <Navigate to="/login" />} />
    </Routes>
  );
}

export default App;
