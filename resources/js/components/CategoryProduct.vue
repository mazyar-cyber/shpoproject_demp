<template>
  <div class="row">
    <!-- product left -->
    <div class="agileinfo-ads-display col-lg-9">
      <div class="wrapper">
        <!-- first section -->
        <div class="product-sec1 px-sm-4 px-3 py-sm-5 py-3 mb-4">
          <div class="row">
            <!-- //we should write here foreach -->
            <div
              style="padding: 10px"
              class="col-md-4 product-men"
              v-for="(product, index) in products.data"
              :key="index"
            >
              <div class="men-pro-item simpleCart_shelfItem">
                <div class="men-thumb-item text-center">
                  <img
                    :src="
                      '/photos/products/' +
                      product.name +
                      '/' +
                      product.photo_path
                    "
                    width="100%"
                    height="200px"
                    alt="product_pic"
                  />
                  <div class="men-cart-pro">
                    <div class="inner-men-cart-pro">
                      <a href="single.html" class="link-product-add-cart"
                        >Quick View</a
                      >
                    </div>
                  </div>
                </div>
                <div class="item-info-product text-center border-top mt-4">
                  <h4 class="pt-1">
                    <a href="single.html">{{ product.name }}</a>
                  </h4>
                  <div class="info-product-price my-2">
                    <span class="item_price">{{
                      product.price - product.discount_price
                    }}</span>
                    <del>{{ product.price }}</del>
                  </div>
                  <div
                    class="
                      snipcart-details
                      top_brand_home_details
                      item_add
                      single-item
                      hvr-outline-out
                    "
                  >
                    <form action="#" method="post">
                      <fieldset>
                        <input type="hidden" name="cmd" value="_cart" />
                        <input type="hidden" name="add" value="1" />
                        <input type="hidden" name="business" value=" " />
                        <input
                          type="hidden"
                          name="item_name"
                          value="Samsung Galaxy J7"
                        />
                        <input type="hidden" name="amount" value="200.00" />
                        <input
                          type="hidden"
                          name="discount_amount"
                          value="1.00"
                        />
                        <input type="hidden" name="currency_code" value="USD" />
                        <input type="hidden" name="return" value=" " />
                        <input type="hidden" name="cancel_return" value=" " />
                        <input
                          type="submit"
                          name="submit"
                          value="Add to cart"
                          class="button btn"
                        />
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- //we should write here foreach -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <center>
            <pagination
              v-model="page"
              :records="25 * products.last_page"
              @paginate="getProducts(page + 1)"
            />
          </center>
        </div>
      </div>
    </div>

    <!-- //product left -->
    <!-- product right -->
    <div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
      <div class="side-bar p-sm-4 p-3">
        <div class="search-hotel border-bottom py-2">
          <h3 class="agileits-sear-head mb-3">Brand</h3>
          <form action="#" method="post">
            <input
              type="search"
              placeholder="Search Brand..."
              name="search"
              required=""
            />
            <input type="submit" value=" " />
          </form>
          <div class="left-side py-2">
            <ul>
              <li v-for="(brand, index) in brands" :key="index">
                <input
                  type="checkbox"
                  class="checked"
                  :value="brand.id"
                  v-model="selectedBrands"
                />
                <span class="span">{{ brand.name }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!-- ram -->
        <div class="left-side border-bottom py-2">
          <h3 class="agileits-sear-head mb-3">Price</h3>
          <select class="form-control" v-model="priceSorting">
            <option value="asc" @click.prevent="getProducts()">
              most expensive
            </option>
            <option value="desc" @click.prevent="getProducts()">
              most cheap
            </option>
          </select>
        </div>
        <!-- //ram -->
        <!-- discounts -->
        <!-- <div class="left-side border-bottom py-2">
          <h3 class="agileits-sear-head mb-3">Discount</h3>
          <select class="form-control" v-model="discountSorting">
            <option value="asc" @click="getProducts()">most discount</option>
            <option value="desc" @click="getProducts()">less discount</option>
          </select>
        </div> -->
        <!-- //discounts -->
        <!-- offers -->
        <div class="left-side border-bottom py-2">
          <h3 class="agileits-sear-head mb-3">Offers</h3>
          <ul>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">Exchange Offer</span>
            </li>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">No Cost EMI</span>
            </li>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">Special Price</span>
            </li>
          </ul>
        </div>
        <!-- //offers -->
        <!-- delivery -->
        <div class="left-side border-bottom py-2">
          <h3 class="agileits-sear-head mb-3">Cash On Delivery</h3>
          <ul>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">Eligible for Cash On Delivery</span>
            </li>
          </ul>
        </div>
        <!-- //delivery -->
        <!-- arrivals -->
        <div class="left-side border-bottom py-2">
          <h3 class="agileits-sear-head mb-3">New Arrivals</h3>
          <ul>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">Last 30 days</span>
            </li>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">Last 90 days</span>
            </li>
          </ul>
        </div>
        <div class="left-side py-2">
          <h3 class="agileits-sear-head mb-3">Availability</h3>
          <ul>
            <li>
              <input type="checkbox" class="checked" />
              <span class="span">Exclude Out of Stock</span>
            </li>
          </ul>
        </div>
        <!-- //arrivals -->
      </div>
      <!-- //product right -->
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: {
    catid: "",
  },
  data() {
    return {
      products: [],
      brands: [],
      selectedBrands: [],
      page: "1",
      priceSorting: "",
      discountSorting: "",
    };
  },
  methods: {
    getProducts() {
      axios
        .post("/frontApi/getCatProducts/" + this.catid + "?page=" + this.page, {
          selectedBrands: this.selectedBrands,
          priceSorting: this.priceSorting,
          discountSorting: this.discountSorting,
        })
        .then((response) => {
          console.log(response.data);
          this.products = response.data;
          this.page = response.data.current_page;
        })
        .catch((error) => console.error(error));
    },
    getBrands() {
      axios
        .get("/frontApi/getBrands/" + this.catid)
        .then((response) => {
          console.log(response.data);
          this.brands = response.data;
        })
        .catch((error) => console.error(error));
    },
  },
  watch: {
    selectedBrands() {
      console.log("some brands selected:" + this.selectedBrands);
      this.page = "1";
      this.getProducts();
    },
  },
  mounted() {
    console.log("Component mounted.");
    this.getProducts();
    this.getBrands();
  },
};
</script>

<style>
.pagination {
  padding-left: 30%;
}
.VuePagination__count {
  display: none;
}
.VuePagination__count_ {
  display: none;
}
</style>
