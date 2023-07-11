import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

const EditCompany = () => {

 const {id} = useParams();
 const navigate = useNavigate(); 

const [formData, setFormData] = useState({
    name: '',
    email: '',
    logo:null,
    website: ''
  });

  
  
  useEffect(() => {
    const fetchCompany = async () => {
      try {
        const response = await axios.get(`http://localhost:8000/api/companies/${id}/edit`);
        const { Name, email, website } = response.data;
        setFormData({ 
            name: Name || '',
            email: email || '',
            website: website || ''
        });
      } catch (error) {
        console.error(error);
      }
    };

    fetchCompany();
  }, [id]);
 
  
  const handleFormChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleFormSubmit = async (e) => {
    e.preventDefault();

    try {
      await axios.put(`http://localhost:8000/api/companies/${id}`, formData);
      const successMessage = 'Company updated successfully';
      navigate(`/companies/${id}?success=${successMessage}`);
    } catch (error) {
      console.error(error);
    }
  };
  return (
    <div class="container mt-5">
        <form onSubmit={handleFormSubmit}>
        <div class="form-group" >
          <label>Name:</label>
          <input class="form-control" type="text" name='name' value={formData.name} onChange={handleFormChange} />
          {/* {errors.name && <p>{errors.name[0]}</p>}  */}
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input class="form-control"  type="email" name='email' value={formData.email} onChange={handleFormChange} />
          {/* {errors.email && <p className="error">{errors.email[0]}</p>} */}
        </div>
        <div class="form-group">
          <label>Logo:</label> 
          <input class="form-control"  type="file"  name='logo' onChange={handleFormChange} />
          {/* {errors.logo && <p className="error">{errors.logo[0]}</p>} */}
        </div>
        <div class="form-group">
          <label>Website:</label>
          <input class="form-control" type="text" name='website' value={formData.website} onChange={handleFormChange} />
          {/* {errors.website && <p className="error">{errors.website[0]}</p>} */}
        </div>
        <p></p>
        <button className='btn btn-primary' type="submit">update</button>
      </form>
    </div>
  )
}

export default EditCompany