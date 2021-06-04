<template>
  <tbody v-if="products.length">
    <product-item
      @edit="edit"
      @delete="deleteProd"
      @image="image"
      @imageSave="imageSave"
      :product="product"
      v-for="(product, index) in products"
      :key="index"
    ></product-item>
  </tbody>
  <tbody v-else>
    <p class="color-gray">(0) products</p>
  </tbody>
</template>
<script>
import productItem from "../products/productItem";
export default {
  props: ["products"],
  components: {
    productItem,
  },
  methods: {
    edit(product) {
      this.$emit("edit", product);
    },
    deleteProd(product) {
      this.$emit("deleteProd", product);
    },
    image(event) {
      this.$emit("image", event);
    },
    imageSave(product){
      this.$emit("imageSave", product);
    }
  },
};
</script>