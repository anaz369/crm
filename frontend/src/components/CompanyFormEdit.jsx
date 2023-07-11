import React from 'react'

const CompanyFormEdit = () => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [logo, setLogo] = useState(null);
    const [website, setWebsite] = useState('');
    const [errors, setErrors] = useState({});
  
    const handleFormSubmit = async (event) => {
      event.preventDefault();

     try {

      const formData = new FormData();
      formData.append('name', name);
      formData.append('email', email);
      formData.append('logo', logo);
      formData.append('website', website);

      const response = await axios.post(`http://localhost:8000/api/companies/edit/${companyId}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
  
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
    <div>
        <form onSubmit={handleFormSubmit}>
        <div>
          <label>Name:</label>
          <input type="text" name='name' onChange={(event) => setName(event.target.value)} />
          {errors.name && <p>{errors.name[0]}</p>} 
        </div>
        <div>
          <label>Email:</label>
          <input type="email" name='email' value={email} onChange={(event) => setEmail(event.target.value)} />
          {errors.email && <p className="error">{errors.email[0]}</p>}
        </div>
        <div>
          <label>Logo:</label>
          <input type="file"  name='logo' onChange={(event) => setLogo(event.target.files[0])} accept="image/*" />
          {errors.logo && <p className="error">{errors.logo[0]}</p>}
        </div>
        <div>
          <label>Website:</label>
          <input type="text" name='website' onChange={(event) => setWebsite(event.target.value)} />
          {errors.website && <p className="error">{errors.website[0]}</p>}
        </div>
        <button type="submit">update</button>
      </form>
    </div>
  )
}

export default CompanyFormEdit