<template>
  <div class="content-right products">
    <h2>Products</h2>
    <div class="content">
      <a
        href=""
        class="btn btn-purple btn-open-modal"
        data-name="modalAddProduct"
        ><i class="fa fa-plus"></i> Add Product</a
      >
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Date</th>
            <th>Time</th>
            <th>Options</th>
          </tr>
        </thead>
        <div class="loader-container" v-if="loader">
          <div class="loader"></div>
        </div>
        <product-list
          :products="this.products"
          @edit="EditProduct"
          @deleteProd="DeleteProduct"
          @image="getImage"
          @imageSave="imageSave"
        ></product-list>
      </table>
    </div>
    <!-- modal Add -->
    <modal @event="AddProduct()" id="modalAddProduct">
      <template slot="modal-content">
        <h3 class="modal-title">Add Product</h3>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <label for="name">Name</label>
              <input
                type="text"
                id="name"
                v-model="product.name"
                class="w-100 form-control"
              />
            </div>
            <div class="form-row">
              <label for="price">Price</label>
              <input
                type="number"
                id="price"
                step="0.1"
                v-model="product.price"
                class="w-100 form-control"
              />
            </div>
            <div class="form-row">
              <label for="stock">Stock</label>
              <input
                type="number"
                id="stock"
                v-model="product.stock"
                class="w-100 form-control"
              />
            </div>
          </form>
        </div>
      </template>
    </modal>
  </div>
</template>
<script>
import modal from "../utilities/modal";
import productList from "../products/productList";
import modalMixin from "../../mixins/modal";
export default {
  mixins: [modalMixin],
  data() {
    return {
      product: { name: "", price: "", stock: "" },
      products: [],
      loader: true,
      image: "",
    };
  },
  mounted() {
    this.getProducts();
  },
  components: {
    modal,
    productList,
  },
  methods: {
    async AddProduct() {
      try {
        if (
          this.product.name == "" ||
          this.product.price == "" ||
          this.product.stock == ""
        ) {
          return false;
        }
        const res = await axios.post("/dashboard/products/store", this.product);
        if (res.status != 200) {
          throw { status: res.status, statusText: res.statusText };
        }
        this.closeModal();
        this.product.name = "";
        this.product.price = "";
        this.product.stock = "";
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },
    async getProducts() {
      this.loader = true;
      try {
        const res = await axios.get("/dashboard/products/getProducts");
        const data = await res.data;
        if (res.status != 200) {
          throw { status: res.status, statusText: res.statusText };
        }
        this.loader = false;
        this.products = data;
      } catch (error) {}
    },
    async EditProduct(product) {
      try {
        if (product.name == "" || product.price == "" || product.stock == "") {
          return false;
        }
        const res = await axios.put(
          `/dashboard/products/update/${product.id}`,
          product
        );
        if (res.status != 200) {
          throw { status: res.status, statusText: res.statusText };
        }
        this.closeModal();
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },
    async DeleteProduct(product) {
      try {
        const res = await axios.delete(
          `/dashboard/products/destroy/${product.id}`,
          product
        );
        if (res.status != 200) {
          throw { status: res.status, statusText: res.statusText };
        }
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },
    async imageSave(product) {
      try {
        if (this.image == "") {
          return false;
        }
        const formData = new FormData();
        formData.append("image", this.image);

        const res = await axios.post(
          `/dashboard/products/image/${product.id}`,
          formData
        );
        this.getProducts();
        this.closeModal();
        this.image = "";
      } catch (error) {
        console.log(error);
      }
    },
    getImage(event) {
      let file = event.target.files[0];
      this.image = file;
    },
  },
};
</script>