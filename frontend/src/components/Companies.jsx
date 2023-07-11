import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom';
import axios from 'axios';
import { useParams, useLocation } from 'react-router-dom';
const Companies = () => {
    const [companies, setCompanies] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [successMessage, setSuccessMessage] = useState('');
    const [updateSuccessMessage, setUpadateSuccessMessage] = useState('');

    const { id } = useParams();
    const location = useLocation();
  
      const fetchCompanies = async () => {
        try {
          const response = await axios.get(`http://localhost:8000/api/companies?page=${currentPage}`);
          setCompanies(response.data.data);
          setTotalPages(response.data.last_page);
        } catch (error) {
          console.error(error);
        }
      };


      useEffect(() => {
        const searchParams = new URLSearchParams(location.search);
        fetchCompanies();
        const message = searchParams.get('success');
        setUpadateSuccessMessage(message || '');
        
      }, [currentPage]);
  
    const handleDelete = async (companyId) => {
      try {
        await axios.delete(`http://localhost:8000/api/companies/delete/${companyId}`);
        setSuccessMessage('deleted successfully');
        fetchCompanies();
      } catch (error) {
        console.error(error);
      }
    };
  return (
    <div>
        <div className='container'>
        <h2 className="mt-5 mb-3">Companies</h2>
        {updateSuccessMessage && <p className="alert alert-success">{updateSuccessMessage}</p>}
        {successMessage && <p className='alert alert-success'>{successMessage}</p>}
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Name</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Logo</th>
                <th class="th-sm">Website</th>
                <th class="th-sm">Actions</th>
              </tr>
            </thead>
            <tbody>
              {companies.map((company) => (          
                <tr key={company.id}>
                  <td>{company.Name}</td>
                  <td>{company.email}</td>
                  <td>
                    {company.logo && (
                      <img
                        src={`/storage/${company.logo}`}
                        alt={company.name}
                        style={{ width: '50px', height: '50px' }}
                      />
                    )}
                  </td>
                  <td>{company.website}</td>
                  <td>
                    <Link  className='btn btn-primary mx-1' to={`/companies/${company.id}/edit`}>Edit</Link> 
                    <button className='btn btn-danger'  onClick={() => handleDelete(company.id)}>Delete</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
          <div className="pt-2">
        <button
          disabled={currentPage === 1}
          onClick={() => setCurrentPage((prevPage) => prevPage - 1)}
        >
          Previous
        </button>
        <span>Page {currentPage} of {totalPages}</span>
        <button
          disabled={currentPage === totalPages}
          onClick={() => setCurrentPage((prevPage) => prevPage + 1)}
        >
          Next
        </button>
      </div>    
      <Link  className='btn btn-primary mt-2'to="/companies/create">Add Company</Link>   
        </div>
            
       </div>
  )
}

export default Companies