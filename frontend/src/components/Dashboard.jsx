import React from 'react'
import { BrowserRouter as Router, Route, Link, Routes } from 'react-router-dom';
import Companies from './Companies';
import CompanyForm from './CompanyForm';
import EditEmployee from './EditEmployee';
import EmployeeForm from './EmployeeForm';
import EditCompany from './EditCompany';
import Employees from './Employees';
const Dashboard = () => { 
    const handleLogout = async () => {
        localStorage.removeItem('token');
        window.location.replace('/login');;
    };
    
  return (
    <div>
    <Router>
    <div>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
     <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
        <Link class="nav-link" to="/companies">Companies</Link>
        </li>
        <li class="nav-item">
        <Link class="nav-link" to="/employees">Employees</Link>
        </li>
        <li class="nav-item">
        <Link class="nav-link " onClick={handleLogout} >logout</Link>
        </li>
      </ul>
    </div>
  </div>
</nav>
      <Routes>
        <Route path="/companies" element={<Companies />} />
        <Route path="/companies/:id" element={<Companies />} />
        <Route path="/employees" element={<Employees/>} />
        <Route path="/companies/create" element={<CompanyForm />} />
        <Route path="/employees/:id/edit" element={<EditEmployee />} />
        <Route path="/employee/create" element={<EmployeeForm />} />
        <Route path="/companies/:id/edit" element={<EditCompany/>} />
      </Routes>
    </div>
  </Router>
    </div>
  )
}

export default Dashboard