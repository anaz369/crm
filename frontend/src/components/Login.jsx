import React, { useState } from 'react';
import axios from 'axios';

const Login = ({ handleLogined }) => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    // console.log(props)
    const handleLogin = async (e) => {
      e.preventDefault();
      setError('');
  
      try {
        const response = await axios.post('http://localhost:8000/api/login', {
          email,
          password,
        });

        localStorage.setItem('token', response.data.token); 
         handleLogined()
      } catch (error) {
        setError('Invalid email or password');
      }
    };
  return (
    <div>
        <div class="container mt-5">
        <h2>Login</h2>
        <form onSubmit={handleLogin}>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control"  placeholder="Enter your email" name="email" value={email} onChange={(e) => setEmail(e.target.value)} required/>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input  class="form-control"  placeholder="Enter your password" type="password" name="password" value={password} onChange={(e) => setPassword(e.target.value)} required  />
          </div>
          {error && <p className='alert alert-danger'>{error}</p>}
          <p></p>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
  )
}

export default Login