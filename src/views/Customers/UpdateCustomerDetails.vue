<template>
  <div class="container mt-4">
    <h2>Update Customer Details</h2>
    <div class="mb-3">
      <label for="customerId" class="form-label">Customer ID:</label>
      <div class="input-group">
        <input
          id="customerId"
          v-model="customer.id"
          class="form-control"
          readonly
        />
      </div>
    </div>
    <form v-if="customer.id" @submit.prevent="updateCustomer" class="needs-validation" novalidate>
      <!-- Form fields here -->
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input id="name" v-model="customer.customer_name" class="form-control" required />
        <div class="invalid-feedback">
          Please provide a name.
        </div>
      </div>
      <div class="mb-3">
        <label for="company" class="form-label">Company:</label>
        <input id="company" v-model="customer.company" class="form-control" required />
        <div class="invalid-feedback">
          Please provide a company name.
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input id="email" v-model="customer.email" type="email" class="form-control" required />
        <div class="invalid-feedback">
          Please provide a valid email.
        </div>
      </div>
      <div class="mb-3">
        <label for="country" class="form-label">Country:</label>
        <input id="country" v-model="customer.country" class="form-control" required />
        <div class="invalid-feedback">
          Please provide a country.
        </div>
      </div>
      <div class="mb-3">
        <label for="firstAddress" class="form-label">Address 1:</label>
        <input id="firstAddress" v-model="customer.firstAddress" class="form-control" required />
        <div class="invalid-feedback">
          Please provide the first address.
        </div>
      </div>
      <div class="mb-3">
        <label for="secondAddress" class="form-label">Address 2:</label>
        <input id="secondAddress" v-model="customer.secondAddress" class="form-control" />
      </div>
      <button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UpdateCustomerDetails',
  data() {
    return {
      customer: {
        id: '',
        customer_name: '',
        company: '',
        email: '',
        country: '',
        firstAddress: '',
        secondAddress: ''
      }
    };
  },
  created() {
    this.fetchCustomerDetails();
  },
  methods: {
    fetchCustomerDetails() {
      const customerId = this.$route.params.id; // Access route param directly
      if (!customerId) {
        alert('No customer ID provided.');
        return;
      }
      axios.get(`http://localhost:8000/api/customers/${customerId}`)
        .then(response => {
          this.customer = response.data.data;
        })
        .catch(error => {
          console.error('Error fetching customer details:', error);
          alert('Error fetching customer details.');
        });
    },
    updateCustomer() {
      const customerId = this.customer.id;
      axios.put(`http://localhost:8000/api/customers/${customerId}`, this.customer)
        .then(response => {
          console.log(response.data);
          alert('Customer details updated successfully.');
          this.$router.push('/customer');
        })
        .catch(error => {
          console.error('Error updating customer:', error);
          if (error.response && error.response.status === 422) {
            alert('Validation error: ' + JSON.stringify(error.response.data.errors));
          } else {
            alert('An error occurred.');
          }
        });
    }
  }
};
</script>

<style scoped>
/* Add custom styles here */
</style>
