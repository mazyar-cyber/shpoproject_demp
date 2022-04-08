

require('./bootstrap');

window.Vue = require('vue').default;

import productCatList from "./components/ProductCatsList.vue";
import CategoryProdcut from "./components/CategoryProduct.vue";
import basketTable from "./components/basketTable.vue";
import Pagination from 'vue-pagination-2';


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product-cat-list', productCatList);
Vue.component('category-products', CategoryProdcut);
Vue.component('basket-table', basketTable);
Vue.component('pagination', Pagination);


const app = new Vue({
    el: '#app',
});
