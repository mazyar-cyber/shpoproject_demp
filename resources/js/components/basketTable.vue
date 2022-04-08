<template>
  <div>
    <div class="table-responsive">
      <table class="timetable_sub">
        <thead>
          <tr>
            <th>SL No.</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Product Name</th>

            <th>Price</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <!-- @foreach ( baskets as  key =>  basket) -->
          <tr v-for="(basket, index) in baskets" :key="index" class="rem1">
            <td class="invert">{{ index + 1 }}</td>
            <td class="invert-image" style="width: 50%">
              <a href="single.html">
                <img
                  width="200px"
                  :src="
                    'photos/products/' +
                    basket.product.name +
                    '/' +
                    basket.product.photo_path
                  "
                  alt="product_pic"
                  class="img-responsive"
                />
              </a>
            </td>
            <td class="invert">
              <div class="quantity">
                <div class="quantity-select">
                  <div
                    class="entry value-minus"
                    @click.prevent="mineProduct(basket.id)"
                  >
                    &nbsp;
                  </div>
                  <div class="entry value" style="background-color: #2b2929">
                    <span>{{ basket.qty }}</span>
                  </div>
                  <div
                    class="entry value-plus active"
                    @click.prevent="addProduct(basket.id)"
                  >
                    &nbsp;
                  </div>
                </div>
              </div>
            </td>
            <td class="invert">{{ basket.product.name }}</td>
            <td class="invert">
              {{ basket.price }}
            </td>
            <td class="invert">
              <div class="rem" @click.prevent="removeBasket(basket.id)">
                <div class="close1"></div>
              </div>
            </td>
          </tr>
          <!-- @endforeach -->
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert2";
export default {
  data() {
    return {
      baskets: [],
    };
  },
  methods: {
    getBaskets() {
      axios
        .get("/frontApi/getBaskets")
        .then((response) => {
          console.log(response.data);
          this.baskets = response.data;
        })
        .catch((error) => console.error(error));
    },
    addProduct(id) {
      axios
        .get("/frontApi/addProductToBasket/" + id)
        .then((response) => {
          console.log(response.data);
          this.getBaskets();
        })
        .catch((error) => console.error(error));
    },
    mineProduct(id) {
      axios
        .get("/frontApi/mineProductToBasket/" + id)
        .then((response) => {
          console.log(response.data);
          if (response.data == "0") {
            swal.fire({
              title: "You cannot set qty 0!",
              icon: "error",
            });
          } else {
            this.getBaskets();
          }
        })
        .catch((error) => console.error(error));
    },
    removeBasket(id) {
      axios
        .get("/frontApi/removeProductFromBasket/" + id)
        .then((response) => {
          console.log(response.data);
          this.getBaskets();
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    this.getBaskets();
  },
};
</script>

<style>
</style>
