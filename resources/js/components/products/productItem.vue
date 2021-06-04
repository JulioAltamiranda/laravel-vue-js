<template>
  <tr>
    <td>{{ product.name }}</td>
    <td>{{ product.price }}</td>
    <td>{{ product.stock }}</td>
    <td>{{ product.date }}</td>
    <td>{{ product.time }}</td>
    <td class="btn-groups">
      <button
        class="btn btn-green btn-open-modal"
        :data-name="`modalEditProduct-${product.id}`"
      >
        <i class="fas fa-edit"></i>
      </button>
      <button
        class="btn btn-purple btn-open-modal"
        :data-name="`modalImage-${product.id}`"
      >
        <i class="fas fa-image"></i>
      </button>
      <button class="btn btn-red" @click="$emit('delete', product)">
        <i class="fas fa-trash"></i>
      </button>
    </td>
    <!-- modal image -->
    <modal @event="$emit('imageSave', product)" :id="`modalImage-${product.id}`">
      <template slot="modal-content">
        <h3 class="modal-title" v-if="product.image">Edit image</h3>
        <h3 class="modal-title" v-else>Add image</h3>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-row">
              <img :src="`../../..${product.image}`" v-if="product.image" class="image-form" alt="">
              <input
                type="file"
                id="name"
                class="w-100"
                @change="$emit('image', $event)"
              />
            </div>
          </form>
        </div>
      </template>
    </modal>
    <!-- modal edit product -->
    <modal
      @event="$emit('edit', product)"
      :id="`modalEditProduct-${product.id}`"
    >
      <template slot="modal-content">
        <h3 class="modal-title">Edit Product</h3>
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
  </tr>
</template>
<script>
import modal from "../utilities/modal";
import modalMixin from "../../mixins/modal";

export default {
  props: ["product"],
  mixins: [modalMixin],
  components: {
    modal,
  },
};
</script>