<template>
  <div>
    <div class="table-responsive border">
      <table class="table text-nowrap text-md-nowrap table-hover mg-b-0">
        <thead>
          <tr>
            <th>شناسه</th>
            <th>نام</th>
            <th>توضیحات</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cat, index) in data" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>
              <input
                type="text"
                v-model="cat.name"
                @keydown.enter="editName(cat.id, cat.name)"
              />
            </td>
            <td>{{ cat.description }}</td>
            <td>
              <input
                type="submit"
                class="btn btn-danger"
                value="حذف"
                @click.prevent="deleteCat(cat.id, index)"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  props: {
    cats: [],
  },
  data() {
    return {
      data: [],
    };
  },
  methods: {
    getData() {
      axios
        .get("/api/getProductsCat")
        .then((response) => {
          console.log(response.data);
          this.data = response.data;
        })
        .catch((error) => console.error(error));
    },
    editName(catId, name) {
      axios
        .post("/api/editProductCatName/" + catId, {
          name: name,
        })
        .then((response) => {
          console.log(response.data);
          if (response.data == "ok") {
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });
            Toast.fire({
              icon: "success",
              title: "ویرایش شد",
            });
          }
        })
        .catch((error) => console.error(error.data));
    },
    deleteCat(catId, key) {
      axios
        .delete("/admin/productCat/" + catId)
        .then((response) => {
          console.log(response.data);
          if (response.data == "ok") {
            this.getData();
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });
            Toast.fire({
              icon: "success",
              title: "حذف شد",
            });
          }
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    console.log("Component mounted.");
    this.getData();
  },
};
</script>
