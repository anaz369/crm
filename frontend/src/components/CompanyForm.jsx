import React, { useState} from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const CompanyForm = () => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [logo, setLogo] = useState(null);
    const [website, setWebsite] = useState('');
    const [errors, setErrors] = useState({});

    const navigate = useNavigate(); 
  
    const handleFormSubmit = async (event) => {
      event.preventDefault();

     try {

      const formData = new FormData();
      formData.append('name', name);
      formData.append('email', email);
      formData.append('logo', logo);
      formData.append('website', website);

      const response = await axios.post('http://localhost:8000/api/companies/create', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      navigate('/companies');
      setErrors({});
    } catch (error) {
      if (error.response && error.response.status === 422) {
        setErrors(error.response.data.errors);
      } else {
        console.error(error);
      }
    }
  }
  return (
    <div class="container">
     <h2 className='mt-5'>Add Company</h2>
      <form onSubmit={handleFormSubmit}>
        <div class="form-group">
          <label>Name:</label>
          <input class="form-control" type="text" name='name' onChange={(event) => setName(event.target.value)} />
          {errors.name && <p>{errors.name[0]}</p>} 
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input class="form-control" type="email" name='email' onChange={(event) => setEmail(event.target.value)} />
          {errors.email && <p className="error">{errors.email[0]}</p>}
        </div>
        <div class="form-group">
          <label>Logo:</label>
          <input class="form-control" type="file"  name='logo' onChange={(event) => setLogo(event.target.files[0])} accept="image/*" />
          {errors.logo && <p className="error">{errors.logo[0]}</p>}
        </div>
        <div class="form-group">
          <label>Website:</label>
          <input class="form-control" type="text" name='website' onChange={(event) => setWebsite(event.target.value)} />
          {errors.website && <p className="error">{errors.website[0]}</p>}
        </div>
        <p></p>
        <button className='btn btn-primary' type="submit">Create</button>
      </form>
    </div>
  )
}

export default CompanyForm