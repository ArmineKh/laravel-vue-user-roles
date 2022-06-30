<template>
    <div>
        <h1 class="text-center">Login</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" v-model="user.email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" v-model="user.password">
                </div>
                <button class="btn btn-primary mt-3" @click="login">Login</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from '../Auth.js';

    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: '',
                }
            };
        },

        methods: {
            login() {
                this.axios.post('http://127.0.0.1:8000/api/login', this.user)
                    .then(({data}) => {
                        Auth.login(data.access_token,data.user); 
                        this.$router.push('/dashboard');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>