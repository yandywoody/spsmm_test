import AllUser from './components/user/AllUser.vue';
import CreateUser from './components/user/CreateUser.vue';
import EditUser from './components/user/EditUser.vue';
import AllLocation from './components/location/AllLocation.vue';
import CreateLocation from './components/location/CreateLocation.vue';
import EditLocation from './components/location/EditLocation.vue';
import AllProduct from './components/product/AllProduct.vue';
import CreateProduct from './components/product/CreateProduct.vue';
import EditProduct from './components/product/EditProduct.vue';
import AllRequest from './components/request/AllRequest.vue';
import CreateRequest from './components/request/CreateRequest.vue';
import DetailRequest from './components/request/DetailRequest.vue';

export const routes = [
    // User
    {
        name: 'user',
        path: '/user',
        component: AllUser
    },
    {
        name: 'user-create',
        path: '/user/create',
        component: CreateUser
    },
    {
        name: 'user-edit',
        path: '/user/edit/:id',
        component: EditUser
    },

    // Location
    {
        name: 'location',
        path: '/location',
        component: AllLocation
    },
    {
        name: 'location-create',
        path: '/location/create',
        component: CreateLocation
    },
    {
        name: 'location-edit',
        path: '/location/edit/:id',
        component: EditLocation
    },

    // Product
    {
        name: 'product',
        path: '/product',
        component: AllProduct
    },
    {
        name: 'product-create',
        path: '/product/create',
        component: CreateProduct
    },
    {
        name: 'product-edit',
        path: '/product/edit/:id',
        component: EditProduct
    },
    
    // Request
    {
        name: 'request',
        path: '/request',
        component: AllRequest
    },
    {
        name: 'request-create',
        path: '/request/create',
        component: CreateRequest
    },
    {
        name: 'request-detail',
        path: '/request/detail/:id',
        component: DetailRequest
    },

    
];