<template>
    <div>
        <h1>Dashboard</h1>
        <a href="javascript:void(0)" @click="logout()" class="nav-item nav-link ml-3">Logout</a>
        <h4>The logged in user details Here</h4><br>
        <p> {{user.name}}</p>
        <p> {{user.email}}</p>

        <div v-if="users">
        <router-link to="/create">Create Users</router-link>
        <h2 class="text-center">Users List</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>
                Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</template>
<script>
import Auth from '../Auth.js';

    export default {
        data () {
            return {
                user: this.auth.user,
                users: []
            }
        },
        created() {
            this.axios
                .get('/api/users/')
                .then(({data}) => {
                    this.users = data;

                }).catch((error) => {
                    console.log(error);
                });

        },
        methods: {
            logout() {
                this.axios.post('/api/logout')
                .then(({data}) => {
                    Auth.logout(); 
                    this.$router.push('/login');
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            deleteUser(id) { 
                this.axios
                    .delete(`/api/users/${id}`)
                    .then(({data}) => {
                        console.log(data)
                        if(data !== 'User not have permission!'){
                            let i = this.users.map(data => data.id).indexOf(id);
                            this.users.splice(i, 1)
                            this.showAlert(data)
                        }else{
                            this.showAlert(data)
                        }
                    }).catch((error) => {
                    console.log(error);
                });
            },
            showAlert(mes){
                alert(mes)
            }
            
        }
    }
</script>