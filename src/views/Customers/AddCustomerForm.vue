<template>
    <div class="container mt-4">
      <h2>{{ isEdit ? 'Edit' : 'Add' }} Customer</h2>
      <form @submit.prevent="saveCustomer" class="needs-validation" novalidate>
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input id="name" v-model="model.customer.customer_name" class="form-control" required />
          <div class="invalid-feedback">
            Please provide a name.
          </div>
        </div>
        <div class="mb-3">
          <label for="company" class="form-label">Company:</label>
          <input id="company" v-model="model.customer.company" class="form-control" required />
          <div class="invalid-feedback">
            Please provide a company name.
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input id="email" v-model="model.customer.email" type="email" class="form-control" required />
          <div class="invalid-feedback">
            Please provide a valid email.
          </div>
        </div>
        <div class="mb-3">
          <label for="country" class="form-label">Country:</label>
          <input id="country" v-model="model.customer.country" class="form-control" required />
          <div class="invalid-feedback">
            Please provide a country.
          </div>
        </div>
        <div class="mb-3">
          <label for="firstAddress" class="form-label">Address 1:</label>
          <input id="firstAddress" v-model="model.customer.firstAddress" class="form-control" required />
          <div class="invalid-feedback">
            Please provide the first address.
          </div>
        </div>
        <div class="mb-3">
          <label for="secondAddress" class="form-label">Address 2:</label>
          <input id="secondAddress" v-model="model.customer.secondAddress" class="form-control" />
        </div>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'AddCustomerForm',
    props: {
      initialCustomer: {
        type: Object,
        default: () => ({
          customer_name: '',
          company: '',
          email: '',
          country: '',
          firstAddress: '',
          secondAddress: ''
        })
      }
    },
    data() {
      return {
        model: {
          customer: this.initialCustomer
        }
      };
    },
    computed: {
      isEdit() {
        return !!this.initialCustomer.id;
      }
    },
    methods: {
      saveCustomer() {
        axios.post('http://localhost:8000/api/customers', this.model.customer)
          .then(res => {
            console.log(res.data);
            alert(res.data.message);
            this.resetForm();
          })
          .catch(error => {
            console.error(error);
            if (error.response && error.response.status === 422) {
              alert('Validation error: ' + JSON.stringify(error.response.data.errors));
            } else {
              alert('An error occurred');
            }
          });
      },
      resetForm() {
        this.model.customer = {
          customer_name: '',
          company: '',
          email: '',
          country: '',
          firstAddress: '',
          secondAddress: ''
        };
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  