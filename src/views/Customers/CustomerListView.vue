<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>
          Customers
          <RouterLink to="/customer/create" class="btn btn-primary float-end">Add customer</RouterLink>
        </h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Company</th>
              <th>Email</th>
              <th>Country</th>
              <th>Created at</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody v-if="this.customers.length > 0">
            <tr v-for="(customer, index) in this.customers" :key="index">
              <td>{{ customer.customer_name }}</td>
              <td>{{ customer.company }}</td>
              <td>{{ customer.email }}</td>
              <td>{{ customer.country }}</td>
              <td>{{ customer.created_at }}</td>
              <td>
                <RouterLink :to="`/customer/edit/${customer.id}`" class="btn btn-success">Edit</RouterLink>

                <button @click="deleteCustomer(customer.id)" class="btn btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5">Loading...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';


export default {
  name: 'customers',
  data(){
    return {
      customers: []
    }
  },
  mounted(){
    //console.log('I am a Customer')
    this.getcustomers();
  },
  methods: {
    getcustomers(){
      axios.get('http://localhost:8000/api/customers').then(res => {
        this.customers = res.data.data
        //console.log(this.customers)
      });
    }, deleteCustomer(customerId) {
      if (confirm('Are you sure you want to delete this customer?')) {
        axios.delete(`http://localhost:8000/api/customers/${customerId}`)
          .then(() => {
            alert('Customer deleted successfully.');
            this.getCustomers(); // Refresh the list
          })
          .catch(error => {
            console.error('Error deleting customer:', error);
            alert('Error deleting customer.');
          });
      }
    }
  }
};
</script>
