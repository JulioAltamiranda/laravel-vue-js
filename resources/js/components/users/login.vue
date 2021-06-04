<template>
  <!-- Wrapper -->
  <div class="login wrapper">
    <!-- card auth -->
    <div class="card-auth">
      <div class="card-image">
        <h2>Welcome!</h2>
        <img src="/img/secure-login.png" alt="image secure login" />
      </div>
      <div class="form-container">
        <div class="card-error" v-if="errorForm">
          {{ errorForm }}
        </div>
        <!-- form login -->
        <transition name="fade" v-if="formLoginActive">
          <form @submit.prevent="login()" class="form-login" method="post">
            <h3>Login</h3>
            <div class="form-row">
              <input
                type="email"
                v-model="dataLogin.email"
                class="form-control"
                placeholder="Email"
              />
              <i class="far fa-envelope"></i>
            </div>
            <div class="form-row">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                v-model="dataLogin.password"
              />
              <i class="fas fa-lock"></i>
            </div>
            <button class="btn btn-purple">Login</button>
            <a href="" @click="setFormLogin($event)">Create new account</a>
          </form>
        </transition>
        <!-- form register -->
        <transition name="fade" v-else>
          <form @submit.prevent="register()" class="form-register">
            <h3>Register</h3>
            <div class="form-row">
              <input
                type="text"
                v-model="dataRegister.name"
                class="form-control"
                placeholder="Your name"
              />
              <i class="fas fa-user"></i>
            </div>
            <div class="form-row">
              <input
                type="email"
                v-model="dataRegister.email"
                class="form-control"
                placeholder="Your email"
              />
              <i class="far fa-envelope"></i>
            </div>
            <div class="form-row">
              <input
                type="password"
                v-model="dataRegister.password"
                class="form-control"
                placeholder="Your password"
              />
              <i class="fas fa-lock"></i>
            </div>
            <button class="btn btn-purple">Register</button>
            <a href="" @click="setFormLogin($event)">Go to login</a>
          </form>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formLoginActive: true,
      dataRegister: {
        name: "",
        email: "",
        password: "",
      },
      dataLogin: {
        email: "",
        password: "",
      },
      errorForm: "",
    };
  },
  methods: {
    setFormLogin(event) {
      event.preventDefault();
      this.errorForm = "";
      this.formLoginActive = !this.formLoginActive;
    },
    async register() {
      if (
        this.dataRegister.name == "" ||
        this.dataRegister.email == "" ||
        this.dataRegister.password == ""
      ) {
        return false;
      }
      try {
        const res = await axios.post("/register", this.dataRegister);
        if (res.status != 200) {
          throw { status: res.status, statusText: res.statusText };
        }
        window.location.href = "/dashboard";
        this.errorForm = "";
      } catch (error) {
        this.errorForm = error.response.data.message;
      }
    },
    async login() {
      if (this.dataLogin.email == "" || this.dataLogin.password == "") {
        return false;
      }
      try {
        const res = await axios.post("/sign-in", this.dataLogin);
        window.location.href = "/dashboard";
        this.errorForm = "";
      } catch (error) {
        this.errorForm = error.response.data.message;
      }
    },
  },
};
</script>

