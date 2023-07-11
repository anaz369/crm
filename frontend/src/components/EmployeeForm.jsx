
import React, { useState,useEffect} from 'react';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

const EmployeeForm = () => {
 
    const [firstName, setFirstName] = useState('');
    const [lastName, setLastName] = useState('');
    const [companyId, setCompanyId] = useState('');
    const [email, setEmail] = useState('');
    const [phone, setPhone] = useState('');
    const [companies, setCompanies] = useState([]);
    const [errors, setErrors] = useState({});

    const navigate = useNavigate(); 

    useEffect(() => {
        fetchCompanies();
      }, []);
    
      const fetchCompanies = async () => {
          const response = await axios.get('http://localhost:8000/api/companies');
          setCompanies(response.data.data);
      };

    const handleFormSubmit = async (event) => {
      event.preventDefault();
    
      try {
        const formData = {
          first_name: firstName,
          last_name: lastName,
          companyId: companyId,
          email,
          phone
        };
    
        await axios.post('http://localhost:8000/api/employees/store', formData);
        alert('Employee created successfully');
        navigate('/employees')
      } catch (error) {
      if (error.response && error.response.status === 422) {
        setErrors(error.response.data.errors);
      } else {
        console.error(error);
      }
    }
    };
  return (
    <div class="container mt-5">
     <h3>Add Employee</h3>
      <form onSubmit={handleFormSubmit}>
        <div class="form-group">
          <label>First Name:</label>
          <input class="form-control" type="text" name='first_name' onChange={(e) => setFirstName(e.target.value)} />
          {errors && errors.first_name && <p className="alert alert-danger">{errors.first_name[0]}</p>}
        </div>
        <div class="form-group">
          <label>Last Name:</label>
          <input class="form-control" type="text" name='last_name' onChange={(e) => setLastName(e.target.value)} />
          {errors && errors.last_name && <p className="alert alert-danger">{errors.last_name[0]}</p>}
        </div>
        <div class="form-group">
          <label>Company:</label>
          <select className='form-control' name='companyId' onChange={(e) => setCompanyId(e.target.value)}>
            <option value="">Select a company</option>
            {companies.map((company) => (
              <option  value={company.id}>
                {company.Name}
              </option>
            ))}
          </select>
          {errors && errors.companyId && <p className="alert alert-danger">{errors.companyId[0]}</p>}
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input class="form-control" type="email" name='email' onChange={(e) => setEmail(e.target.value)} />
          {errors && errors.email && <p className="alert alert-danger">{errors.email[0]}</p>}
        </div>
        <div class="form-group">
          <label>Phone:</label>
          <input class="form-control" type="" name='phone' onChange={(e) => setPhone(e.target.value)}  />
          {errors && errors.phone && <p className="alert alert-danger">{errors.phone[0]}</p>}
        </div>
        <p></p>
        <button className='btn btn-primary' type="submit">Create</button>
      </form>
    </div>
  )
}

export default EmployeeForm