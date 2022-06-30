<template>
    <div>
        <h1 class="text-center">Register</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" v-model="user.name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" v-model="user.email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" v-model="user.password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" type="password" v-model="user.password_confirmation">
                </div>
                <button @click="register()" class="btn btn-primary mt-3">Register</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }
            };
        },

        methods: {
            register() {
                console.log(this.user);
                this.axios.post('http://127.0.0.1:8000/api/register', this.user)
                    .then(({data}) => {
                        this.$router.push('/login');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>