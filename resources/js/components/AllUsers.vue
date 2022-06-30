<template>

    <div>
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
            <tr v-for="users in user" :key="user.id">
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
</template>
 
<script>
    export default {
        
        data() {
            return {
                users: [],
                authUser: {}
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/users/')
                .then(response => {
                    this.users = response.data.users;

                });
                console.log(this.users);
        },
        methods: {
            
        }
    }
</script>