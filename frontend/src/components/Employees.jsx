import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom';
import axios from 'axios';


const Employees = () => {
    const [employees, setEmployees] = useState([]);
    const [successMessage, setSuccessMessage] = useState('');
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
  
    useEffect(() => {
      fetchEmployees();
    }, [currentPage]);
  
    const fetchEmployees = async () => {
        const response = await axios.get('http://localhost:8000/api/employees');
        setEmployees(response.data.data);
    };
  
    const deleteEmployee = async (employeeId) => {
        await axios.delete(`http://localhost:8000/api/employees/delete/${employeeId}`);
        setSuccessMessage('deleted successfully');
        fetchEmployees();
    };
  return (
    <div>
        <div className='container'>
        <h2 className='mb-3'>Employees</h2>
        {successMessage && <p className='alert alert-success'>{successMessage}</p>}
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">First Name</th>
                <th class="th-sm">Last Name</th>
                <th class="th-sm">Company</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Phone</th>
                <th class="th-sm">Actions</th>
              </tr>
            </thead>
            <tbody>
              {employees.map((employee) => (
                <tr key={employee.id}>
                  <td>{employee.First_name}</td>
                  <td>{employee.last_name}</td>
                  <td>{employee.company.Name}</td>
                  <td>{employee.email}</td>
                  <td>{employee.phone}</td>
                  <td>
                    <Link class="btn btn-warning mr-5 mx-1 " to={`/employees/${employee.id}/edit`}>edit</Link>
                    <button class='btn btn-danger' onClick={() => deleteEmployee(employee.id)}>Delete</button>
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
      <p></p>
          <Link className='btn btn-primary' to="/employee/create">Add Employee</Link> 
          </div>
  
    </div>
  )
}

export default Employees