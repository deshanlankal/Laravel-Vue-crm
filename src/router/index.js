import { createRouter, createWebHistory } from 'vue-router'

import CustomerListView from '../views/Customers/CustomerListView.vue'
import AddCustomerForm from '../views/Customers/AddCustomerForm.vue'
import UpdateCustomerDetails from '../views/Customers/UpdateCustomerDetails.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/customer',
      name: 'customerlistview',
      component: CustomerListView
    },
    {
      path: '/customer/create',
      name: 'AddCustomerForm',
      component: AddCustomerForm
    },
    {
      path: '/customer/edit/:id',
      name: 'UpdateCustomerDetails',
      component: UpdateCustomerDetails
    }
    
  ]
})

export default router
