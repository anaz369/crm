import './App.css';
import React, { useState } from 'react';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import { BrowserRouter as Router, Route, Switch, Routes } from 'react-router-dom';

function App() {

  const [loggedIn, setLoggedIn] = useState(false);

  const handleLogined = () => {
    setLoggedIn(true);
  };
  return (
    <div>
    <div>
      {loggedIn ? <Dashboard /> : <Login handleLogined={handleLogined} />}
    </div>
    </div>
  )
}

export default App;
