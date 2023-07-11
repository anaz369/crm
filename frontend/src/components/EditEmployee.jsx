import React, { useEffect, useState } from 'react';
import { useParams,useNavigate} from 'react-router-dom';
import axios from 'axios';

const EditEmployee = () => {

    const { id } = useParams();
    const navigate = useNavigate(); 
    const [companies, setCompanies] = useState([]);
  
    const [formData, setFormData] = useState({
      first_name: '',
      last_name: '',
      companyId: '',
      email: '',
      phone: '',
    });

    
  useEffect(() => {
    fetchEmployee();
    fetchCompanies()
  }, [id]);

  const fetchEmployee = async () => {
    try {
      const response = await axios.get(`http://localhost:8000/api/employees/${id}/edit`);
      const { First_name, last_name, companyId, email, phone } = response.data;
      setFormData({
        first_name : First_name || '',
        last_name : last_name || '',
        companyId : companyId || '',
        email : email || '',
        phone : phone || '' 

        });
    } catch (error) {
      console.error(error);
    }
  };

  const fetchCompanies = async () => {
    try {
      const response = await axios.get('http://localhost:8000/api/companies');
      const companies = response.data.data;
      setCompanies(companies);
    } catch (error) {
      console.error(error);
    }
  };


  const handleFormChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleFormSubmit = async (e) => {
    e.preventDefault();

    try {
      await axios.put(`http://localhost:8000/api/employees/${id}`, formData);
      alert('Employee updated successfully');
    navigate('/employees');
    } catch (error) {
      console.error(error);
    }
  };
  return (
    <div class="container mt-5">
     <form onSubmit={handleFormSubmit}>
        <div class="form-group">
          <label>First Name:</label>
          <input class="form-control" type="text" name='first_name' value={formData.first_name} onChange={handleFormChange} />
          {/* {errors && errors.first_name && <p className="alert alert-danger">{errors.first_name[0]}</p>} */}
        </div>
        <div class="form-group">
          <label>Last Name:</label>
          <input class="form-control" type="text" name='last_name' value={formData.last_name} onChange={handleFormChange}  />
          {/* {errors && errors.last_name && <p className="alert alert-danger">{errors.last_name[0]}</p>} */}
        </div>
        <div class="form-group">
          <label>Company:</label>
          <select class="form-control" name='companyId'value={formData.companyId}
              onChange={handleFormChange} >
            <option value="">Select a company</option>
            {companies.map((company) => (
              <option  value={company.id}>
                {company.Name}
              </option>
            ))}
          </select>
          {/* {errors && errors.companyId && <p className="alert alert-danger">{errors.companyId[0]}</p>} */}
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input class="form-control" type="email" name='email' onChange={handleFormChange} value={formData.email} />
          {/* {errors && errors.email && <p className="alert alert-danger">{errors.email[0]}</p>} */}
        </div>
        <div class="form-group">
          <label>Phone:</label>
          <input class="form-control" type="" name='phone' onChange={handleFormChange} value={formData.phone}/>
          {/* {errors && errors.phone && <p className="alert alert-danger">{errors.phone[0]}</p>} */}
        </div>
        <p></p>
        <button className='btn btn-primary' type="submit">update</button>
      </form>
    </div>
  )
}

export default EditEmployee